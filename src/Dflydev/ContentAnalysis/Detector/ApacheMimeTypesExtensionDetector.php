<?php

namespace Dflydev\ContentAnalysis\Detector;

use Dflydev\ApacheMimeTypes\PhpRepository;
use Dflydev\ApacheMimeTypes\RepositoryInterface;
use Dflydev\ContentAnalysis\MediaType\MediaTypeParserInterface;
use Dflydev\ContentAnalysis\Metadata\Metadata;

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

    public function detect(MediaTypeParserInterface $mediaTypeParser, $input = null, Metadata $metadata = null)
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
            return $mediaTypeParser->parse($type);
        }

        return null;
    }
}
