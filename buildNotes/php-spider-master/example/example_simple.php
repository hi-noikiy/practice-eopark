<?php

use VDB\Spider\Discoverer\XPathExpressionDiscoverer;
use Symfony\Component\EventDispatcher\Event;
use VDB\Spider\Event\SpiderEvents;
use VDB\Spider\StatsHandler;
use VDB\Spider\Spider;

require_once __DIR__ . '/../vendor/autoload.php';

// Create Spider
$spider = new Spider('http://68ps.com/jc/ps_wz.asp');

// Add a URI discoverer. Without it, the spider does nothing. In this case, we want <a> tags from a certain <div>
$spider->getDiscovererSet()->set(new XPathExpressionDiscoverer("//tr[@class='in-center4']"));

// Set some sane options for this example. In this case, we only get the first 10 items from the start page.
$spider->getDiscovererSet()->maxDepth    = 3;
$spider->getQueueManager()->maxQueueSize = 10;

// Let's add something to enable us to stop the script
$spider->getDispatcher()->addListener(SpiderEvents::SPIDER_CRAWL_USER_STOPPED, function (Event $event) {
    echo "\nCrawl aborted by user.\n";
    exit();
});

// Add a listener to collect stats to the Spider and the QueueMananger.
// There are more components that dispatch events you can use.
$statsHandler = new StatsHandler();
$spider->getQueueManager()->getDispatcher()->addSubscriber($statsHandler);
$spider->getDispatcher()->addSubscriber($statsHandler);

// Execute crawl
$spider->crawl();

// Build a report
echo "\r\n  ENQUEUED:  " . count($statsHandler->getQueued());
echo "\r\n  SKIPPED:   " . count($statsHandler->getFiltered());
echo "\r\n  FAILED:    " . count($statsHandler->getFailed());
echo "\r\n  PERSISTED:    " . count($statsHandler->getPersisted());

// Finally we could do some processing on the downloaded resources
// In this example, we will echo the title of all resources
echo "\n\nDOWNLOADED RESOURCES: ";
foreach ($spider->getDownloader()->getPersistenceHandler() as $key => $resource) {
    $data = $resource->getCrawler()->filterXpath("//tr[@class='in-center4']//a")->each(function ($node, $i) {
        return $node->attr('href');
    });


    foreach ($data as $value) {
        echo $value . "\n";
        echo "<br />";
    }
    echo "\n - " . $key;

}
