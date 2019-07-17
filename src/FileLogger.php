<?php

namespace App;

class FileLogger implements LoggerInterface
{
    const FILE_PATH_PART = '/logs/tram';
    const EXTENSION = '.log';

    /**
     * @param string $message
     * @throws \Exception
     */
    public function log(string $message)
    {
        $filePath = $this->getFilePath();
        $handle = fopen($filePath, 'a');
        $this->validateFile($handle);
        fwrite($handle, $message . PHP_EOL);
        fclose($handle);
    }

    /**
     * @return string
     */
    private function getFilePath()
    {
        return dirname(__DIR__, 1) . self::FILE_PATH_PART . date("Y_m_d_h_i_s") . self::EXTENSION;
    }

    /**
     * @param $file
     * @throws \Exception
     */
    private function validateFile($file)
    {
        if ($file === false) {
            throw new \Exception("File not found or can't be open by other reasons");
        }
    }
}