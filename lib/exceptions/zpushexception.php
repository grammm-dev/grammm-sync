<?php
/*
 * SPDX-License-Identifier: AGPL-3.0-only
 * SPDX-FileCopyrightText: Copyright 2007-2016 Zarafa Deutschland GmbH
 * SPDX-FileCopyrightText: Copyright 2020 grammm GmbH
 *
 * Main grammm-sync exception
 */

class ZPushException extends Exception {
    protected $defaultLogLevel = LOGLEVEL_FATAL;
    protected $httpReturnCode = HTTP_CODE_500;
    protected $httpReturnMessage = "Internal Server Error";
    protected $httpHeaders = array();
    protected $showLegal = true;

    public function __construct($message = "", $code = 0, $previous = NULL, $logLevel = false) {
        if (! $message)
            $message = $this->httpReturnMessage;

        if (!$logLevel)
            $logLevel = $this->defaultLogLevel;

        parent::__construct($message, (int) $code);
        ZLog::Write($logLevel, get_class($this) .': '. $message . ' - code: '.$code. ' - file: '. $this->getFile().':'.$this->getLine(), false);
    }

    public function getHTTPCodeString() {
        return $this->httpReturnCode . " ". $this->httpReturnMessage;
    }

    public function getHTTPHeaders() {
        return $this->httpHeaders;
    }

    public function showLegalNotice() {
        return $this->showLegal;
    }
}
