<?php
/*
 * SPDX-License-Identifier: AGPL-3.0-only
 * SPDX-FileCopyrightText: Copyright 2007-2016 Zarafa Deutschland GmbH
 * SPDX-FileCopyrightText: Copyright 2020 grammm GmbH
 *
 * Interface for interprocess communication
 * providers for different purposes.
 */

interface IIpcProvider
{
    /**
     * Constructor
     *
	 * @param int $type
	 * @param int $allocate
	 * @param string $class
	 * @param string $serverKey
	 */
    public function __construct($type, $allocate, $class, $serverKey);

    /**
     * Reinitializes the IPC data. If the provider has no way of performing
     * this action, it should return 'false'.
     *
     * @access public
     * @return boolean
     */
    public function ReInitIPC();

    /**
     * Cleans up the IPC data block.
     *
     * @access public
     * @return boolean
     */
    public function Clean();

    /**
     * Indicates if the IPC is active.
     *
     * @access public
     * @return boolean
     */
    public function IsActive();

    /**
     * Blocks the class mutex.
     * Method blocks until mutex is available!
     * ATTENTION: make sure that you *always* release a blocked mutex!
     *
     * @access public
     * @return boolean
     */
    public function BlockMutex();

    /**
     * Releases the class mutex.
     * After the release other processes are able to block the mutex themselves.
     *
     * @access public
     * @return boolean
     */
    public function ReleaseMutex();

    /**
     * Indicates if the requested variable is available in IPC data.
     *
     * @param int   $id     int indicating the variable
     *
     * @access public
     * @return boolean
     */
    public function HasData($id = 2);

    /**
     * Returns the requested variable from IPC data.
     *
     * @param int   $id     int indicating the variable
     *
     * @access public
     * @return mixed
     */
    public function GetData($id = 2);

    /**
     * Writes the transmitted variable to IPC data.
     * Subclasses may never use an id < 2!
     *
     * @param mixed $data   data which should be saved into IPC data
     * @param int   $id     int indicating the variable (bigger than 2!)
     *
     * @access public
     * @return boolean
     */
    public function SetData($data, $id = 2);
}
