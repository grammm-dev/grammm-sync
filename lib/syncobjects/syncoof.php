<?php
/*
 * SPDX-License-Identifier: AGPL-3.0-only
 * SPDX-FileCopyrightText: Copyright 2007-2016 Zarafa Deutschland GmbH
 * SPDX-FileCopyrightText: Copyright 2020 grammm GmbH
 *
 * WBXML appointment entities that can be parsed directly (as a stream) from
 * WBXML. It is automatically decoded according to $mapping and the Sync
 * WBXML mappings.
 */

class SyncOOF extends SyncObject {
    public $oofstate;
    public $starttime;
    public $endtime;
    public $oofmessage = array();
    public $bodytype;
    public $Status;

    public function __construct() {
        $mapping = array (
            SYNC_SETTINGS_OOFSTATE      => array (  self::STREAMER_VAR      => "oofstate",
                                                    self::STREAMER_CHECKS   => array(   array(   self::STREAMER_CHECK_ONEVALUEOF => array(0,1,2) ))),

            SYNC_SETTINGS_STARTTIME      => array (  self::STREAMER_VAR      => "starttime",
                                                    self::STREAMER_TYPE     => self::STREAMER_TYPE_DATE_DASHES),

            SYNC_SETTINGS_ENDTIME       => array (  self::STREAMER_VAR      => "endtime",
                                                    self::STREAMER_TYPE     => self::STREAMER_TYPE_DATE_DASHES),

            SYNC_SETTINGS_OOFMESSAGE    => array (  self::STREAMER_VAR      => "oofmessage",
                                                    self::STREAMER_TYPE     => "SyncOOFMessage",
                                                    self::STREAMER_PROP     => self::STREAMER_TYPE_NO_CONTAINER,
                                                    self::STREAMER_ARRAY    => SYNC_SETTINGS_OOFMESSAGE),

            SYNC_SETTINGS_BODYTYPE      => array (  self::STREAMER_VAR      => "bodytype",
                                                    self::STREAMER_CHECKS   => array(   self::STREAMER_CHECK_ONEVALUEOF => array(SYNC_SETTINGSOOF_BODYTYPE_HTML, ucfirst(strtolower(SYNC_SETTINGSOOF_BODYTYPE_TEXT))) )),

            SYNC_SETTINGS_PROP_STATUS   => array (  self::STREAMER_VAR      => "Status",
                                                    self::STREAMER_TYPE     => self::STREAMER_TYPE_IGNORE)
        );

        parent::__construct($mapping);
    }

}
