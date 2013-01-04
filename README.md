Canal
=====

Content analysis for the purpose of determining [Internet media types][1].


Requirements
------------

 * PHP 5.3+


Installation
------------
 
Through [Composer][2] as [dflydev/canal][3].


Usage
-----

```php
<?php

// Instantiate the Analyzer
$analyzer = new Dflydev\Canal\Analyzer\Analyzer;

// Detect a media type from a filename (file does not need to exist)
$internetMediaType = $analyzer->detectFromFilename('/path/to/whatever.png');

// See the media type as a string
print $internetMediaType->asString()."\n\n";

// See the media type's type
print $internetMediaType->getType()."\n\n";

// See the media type's subtype
print $internetMediaType->getSubtype()."\n\n";

// image/png
//
// image
//
// png
```


License
-------

MIT, see LICENSE.


Not Invented Here
-----------------

This work was heavily influenced by [Apache Tika][4] and [Ferret][5].


[1]: http://en.wikipedia.org/wiki/Internet_media_type
[2]: http://getcomposer.org
[3]: https://packagist.org/packages/dflydev/canal
[4]: http://tika.apache.org
[5]: https://github.com/versionable/Ferret