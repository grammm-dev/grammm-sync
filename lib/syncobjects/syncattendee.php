<?php
/*
 * SPDX-License-Identifier: AGPL-3.0-only
 * SPDX-FileCopyrightText: Copyright 2007-2016 Zarafa Deutschland GmbH
 * SPDX-FileCopyrightText: Copyright 2020 grammm GmbH
 *
 * WBXML attendee entities that can be parsed directly (as a stream) from
 * WBXML. It is automatically decoded according to $mapping and the Sync
 * WBXML mappings.
 */

class SyncAttendee extends SyncObject {
    public $email;
    public $name;
    public $attendeestatus;
    public $attendeetype;

    function __construct() {
        $mapping = array(
                    SYNC_POOMCAL_EMAIL                                  => array (  self::STREAMER_VAR      => "email",
                                                                                    self::STREAMER_CHECKS   => array(   self::STREAMER_CHECK_REQUIRED => self::STREAMER_CHECK_SETEMPTY),
                                                                                    self::STREAMER_RONOTIFY => true,
                                                                                    self::STREAMER_PRIVATE  => 'attendee@localhost'),

                    SYNC_POOMCAL_NAME                                   => array (  self::STREAMER_VAR      => "name",
                                                                                    self::STREAMER_CHECKS   => array(   self::STREAMER_CHECK_REQUIRED => self::STREAMER_CHECK_SETEMPTY),
                                                                                    self::STREAMER_RONOTIFY => true,
                                                                                    self::STREAMER_PRIVATE  => 'Undisclosed Attendee')
                );

        if (Request::GetProtocolVersion() >= 12.0) {
            $mapping[SYNC_POOMCAL_ATTENDEESTATUS]                       =  array (  self::STREAMER_VAR      => "attendeestatus",
                                                                                    self::STREAMER_RONOTIFY => true,
                                                                                    self::STREAMER_PRIVATE  => true
            );
            $mapping[SYNC_POOMCAL_ATTENDEETYPE]                         =  array (  self::STREAMER_VAR      => "attendeetype",
                                                                                    self::STREAMER_RONOTIFY => true,
                                                                                    self::STREAMER_PRIVATE  => true
            );
        }

        parent::__construct($mapping);

        // Indicates that this SyncObject supports the private flag and stripping of private data.
        $this->supportsPrivateStripping = true;
    }
}
