Content Analysis
================

Analyze content to determine the appropriate [Internet media type][1].


Requirements
------------

 * PHP 5.3+



Installation
------------
 
Through [Composer][2] as [dflydev/content-analysis][3].


Usage
-----

    // Instantiate the Analyzer
    $analyzer = new Dflydev\ContentAnalysis\Analyzer\Analyzer;

    // Detect a media type from a filename (file does not need to exist)
    $mediaType = $analyzer->detectFromFilename('/path/to/whatever.png');

    // See the media type as a string
    print $mediaType."\n";

    // Explore the media type
    print var_dump($mediaType);
    
    // image/png
    //
    // object(webignition\InternetMediaType\InternetMediaType)#8 (3) {
    //  ["type":"webignition\InternetMediaType\InternetMediaType":private]=>
    //  string(5) "image"
    //  ["subtype":"webignition\InternetMediaType\InternetMediaType":private]=>
    //  string(3) "png"
    //  ["parameters":"webignition\InternetMediaType\InternetMediaType":private]=>
    //  array(0) {
    //  }
    //}



License
-------

MIT, see LICENSE.


Not Invented Here
-----------------

This work was heavily influenced by [Apache Tika][4] and [Ferret][5].


[1]: http://en.wikipedia.org/wiki/Internet_media_type
[2]: http://getcomposer.org
[3]: https://packagist.org/packages/dflydev/content-analysis
[4]: http://tika.apache.org
[5]: https://github.com/versionable/Ferret