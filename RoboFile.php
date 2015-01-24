<?php

use \Robo\Tasks;
use \coverallskit\robo\loadTasks as CoverallsKitTasks;
use \peridot\robo\loadTasks as PeridotTasks;


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
            ->configureBy('coveralls.toml')
            ->run();

        return $result;
    }

}
