<?php

namespace Dflydev\Canal\Detector;

use Dflydev\ApacheMimeTypes\PhpRepository;
use Dflydev\ApacheMimeTypes\RepositoryInterface;
use Dflydev\Canal\InternetMediaType\InternetMediaTypeParserInterface;
use Dflydev\Canal\Metadata\Metadata;

class ApacheMimeTypesExtensionDetector implements DetectorInterface
{
    private $repository;

    public function __construct(RepositoryInterface $repository = null)
    {
        if (null === $repository) {
            $repository = new PhpRepository;
        }

        $this->repository = $repository;
    }

    public function detect(InternetMediaTypeParserInterface $internetMediaTypeParser, $input = null, Metadata $metadata = null)
    {
        if (null === $metadata) {
            return null;
        }

        $filepath = $metadata->get(Metadata::RESOURCE_NAME_KEY);

        if (null === $filepath) {
            return null;
        }

        $extension = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));

        $type = $this->repository->findType($extension);

        if (null !== $type) {
            return $internetMediaTypeParser->parse($type);
        }

        return null;
    }
}
