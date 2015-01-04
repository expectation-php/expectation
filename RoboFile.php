<?php

use \Robo\Tasks;
use \coverallskit\robo\CoverallsKitTasks;
use \peridot\robo\PeridotTasks;


/**
 * Class RoboFile
 */
class RoboFile extends Tasks
{

    use CoverallsKitTasks;
    use PeridotTasks;


    public function specAll()
    {
        $result = $this->taskPeridot()
            ->directoryPath('spec')
            ->run();

        return $result;
    }

    public function phpMetrics()
    {
        return $this->taskExec('vendor/bin/phpmetrics src')->run();
    }

    public function coverallsUpload()
    {
        $result = $this->taskCoverallsKit()
            ->configure('coveralls.toml')
            ->run();

        return $result;
    }

}
