<?php

	# ---------------------------------------------------------------------------------------
	# Database Abstraction Layer
	# Primary Class Author: Frank M. Kromman <frank@frontbase.com>
	# Docs, MySQL Support, and Minor Class Modifications: Geoff A. Virgo <gvirgo@mithril.com>
	# Release Date: November 11, 2001
	# Licensing: Lesser GNU Public License (LGPL)
	# ---------------------------------------------------------------------------------------
	# Requirements:
	#
	#    - PHP 4.0.0 or higher (may also work with PHP3) configured with smtp or
	#      sendmail support
	#    - a webserver configured to run PHP
	#
	# For installation and usage, read the README section in the API Docs.
	#

	/** The base class used to store database connection resource identifiers, number of columns 
	 ** and rows in a result set, available database objects, and provide error-handling via runtime 
	 ** debugging emails.&nbsp; The class is private and shouldn't be accessed directly.
	 ** @author Frank M. Kromann <frank@frontbase.com>
	 ** @author Geoff A. Virgo <gvirgo@mithril.ca> - internal documentation and minor code revision
	 **/
	class cDBConstruct {

		/** This is an integer variable used to store the resource
		 ** identifer for the current database connection.
		 ** @type int
		 ** @public
		 **/
		var $conn;

		/** This is an integer variable used to store the number
		 ** of columns in the current result set.
		 ** @type int
		 ** @public
		 **/
		var $columns;

		/** This is an integer variable used to store the number
		 ** of rows in the current result set.
		 ** @type int
		 ** @public
		 **/
		var $rows;

		/** This is an integer variable used to store the number
		 ** of rows in the current result set.
		 ** @type int
		 ** @public
		 **/
		var $row;

		/** This is an integer variable used to store the current 
		 ** date at the time of instanciation.
		 ** @type int 
		 ** @public
		 **/
		var $currentDate;

		/** This is an integer variable used to store the current 
		 ** system time at the time of instanciation.
		 ** @type int 
		 ** @public
		 **/
		var $currentTime;

		/** This is a string variable used to store the address 
		 ** to which debugging emails are sent.
		 ** @type string 
		 ** @public
		 **/
		var $adminEmail;

		/** This is a string variable used to store the name of the 
		 ** webserver or virtual host.
		 ** @type string 
		 ** @private
		 **/
		var $serverName;

		/** This is a string variable used to store the name of 
		 ** the webserver software.
		 ** @type string 
		 ** @private
		 **/
		var $serverSoftware;

		/** This is a string variable used to store the address 
		 ** which the webserver is running on.
		 ** @type string 
		 ** @private
		 **/
		var $serverAddress;

		/** This is a string variable used to store the relative 
		 ** path and filename of the file calling this class.
		 ** @type string 
		 ** @private
		 **/
		var $currentScript;
		
		/** The class constructor returns nothing, it merely sets the 
		 ** resource id, number of rows, number of columns, date, 
		 ** and time variables to their default state.
		 ** @private
		 **/
		function cDBConstruct() 
		{
			global $HTTP_SERVER_VARS;

			$this->conn = NULL;
			$this->columns = NULL;
			$this->rows = NULL;	
			$this->currentDate = date("Y-m-d");
			$this->currentTime = date("H:i:s");
			$this->row = 0;
			
			$this->serverName = $HTTP_SERVER_VARS["SERVER_NAME"];
			$this->serverSoftware = $HTTP_SERVER_VARS["SERVER_SOFTWARE"];
			$this->currentScript = $HTTP_SERVER_VARS["PATH_TRANSLATED"];

			$this->SetAdminEmail();
		}

		/** This function sets the email address used in the SQL debugging
		 ** methods below.
		 ** @returns void
		 ** @public
		 **/
		function SetAdminEmail($email="") 
		{
			global $admin_email;

			$email=="" ? $this->adminEmail = $admin_email : $this->adminEmail = $email;
			return true;
		}

		/** The error handling function called in a die operation upon failure to 
		 ** create a connection to the specified server.  Sends a brief email to a 
		 ** designated admin email account (specified in settings file as 
		 ** $admin_email) notifying of the failure.
		 ** @returns void
		 ** @private
		 **/
		function _DBConnectionError() 
		{
			global $HTTP_SERVER_VARS;

			  // create email body
			$body = "On " . $this->currentDate . " at " . $this->currentTime . ", a user was unable to ";
			$body .= "connect to the database server.  The error occured in " . $this->currentScript . ".";

			$HTTP_SERVER_VARS["SERVER_ADDR"] == "24.78.38.253" ? $send = TRUE : $send = FALSE;
				
			if ($send)
				$this->_sendMail($body);
			else
				echo nl2br($body) . "<br>";

			return false;
		}

		/** The error handling function called in a die operation upon failure to 
		 ** create a select a database on the current connection.  Sends a 
		 ** brief email to a designated admin email account (specified in settings file as 
		 ** $admin_email) notifying of the failure.
		 ** @returns void
		 ** @private
		 **/
		function _DBSelectionError() 
		{
			global $HTTP_SERVER_VARS;

			  // create email body
			$body = "On " . $this->currentDate . " at " . $this->currentTime . ", a user connected to ";
			$body .= "the database server but was unable to select the correct database.  The error ";
			$body .= "occured in " . $this->currentScript . ".";

			$HTTP_SERVER_VARS["SERVER_ADDR"] == "24.78.38.253" ? $send = TRUE : $send = FALSE;
				
			if ($send)
				$this->_sendMail($body);
			else
				echo nl2br($body) . "<br>";

			return false;
		}

		/** The error handling function called in a die operation upon failure to 
		 ** execute an SQL query.  Sends a brief email to a designated admin 
		 ** email account (specified in settings file as $admin_email) notifying 
		 ** of the failure, detailing the file in which the failure occured, and providing 
		 ** the faulty query.
		 ** @returns void
		 ** @private
		 **/
		function _SQLError($sql,$error) 
		{
			global $HTTP_SERVER_VARS;

			  // create email body
			$body = "On " . $this->currentDate . " at " . $this->currentTime . ", an sql error occured.  ";
			$body .= "When asked the trouble, the database said:\n\n\"".trim($error)."\"\n\n";
			$body .= "The error was thrown from " . $this->currentScript . " in the function $type and ";
			$body .= "the offending sql statement is below:\n\n\n$sql";

			$HTTP_SERVER_VARS["SERVER_ADDR"] == "24.78.38.253" ? $send = TRUE : $send = FALSE;
				
			if ($send)
				$this->_sendMail($body);
			else
				echo nl2br($body) . "<br>";

			return false;
		}

		/** The function used to send sql error report emails.
		 ** @returns void
		 ** @private
		 **/
		function _sendMail($body,$to="",$subject="",$headers="",$cc="",$bcc="",$html=false)
		{
			global $HTTP_SERVER_VARS;

			if ($headers == "") {				
				$headers = "From: \"Automated Script Debugger System at " . $this->serverName . "\"\nReply-To: ";
				$headers .= "\"Automated Script Debugger System at " . $this->serverName . "\"\nX-Mailer: \"";
				$headers .= $this->serverName . " via " . $this->serverSoftware . "\"";
			}

			if ($subject == "")
				$subject = "Script Error";
			if ($html)
				$headers .= "Content-Type: text/html; charset=iso-8859-1\n";
			if ($cc != "")
				$headers .= $cc;
			if ($bcc != "")
				$headers .= $bcc;

			$to == "" ? $to = $this->adminEmail : TRUE;
			$HTTP_SERVER_VARS["SERVER_ADDR"] == "127.0.0.1" ? $send = FALSE : $send = TRUE;
				
			if ($send)
				@mail($to, $subject, $body, $headers);  
			else
				echo nl2br($body) . "<br>";			
		}
	}

	/** A class used to wrap PHP's FrontBase connectivity functions.  While it can be 
	 ** accessed directly, the recommended method is to access it through the wrapper
	 ** Databases() class.
	 ** @author Frank M. Kromann <frank@frontbase.com>
	 ** @author Geoff A. Virgo <gvirgo@mithril.ca> - internal documentation
	 **/
	class cFrontBase extends cDBConstruct {

		/** The class constructor undertakes no actions beyond returning boolean true.&nbsp;
		 ** It is included merely for good style and against the needs of future expansion.
		 **/
		 function cFrontBase() 
		 {
			  $this->cDBConstruct();
		      return true;
		 }
		
		/** This method is used to connect to the specified FrontBase server.  All accepted 
		 ** arguments are strings, with $strDatabase being optional.  If $strDatabase is specified
		 ** the method will try to select that database.
		 ** @returns void
		 ** @public
		 **/
		function Connect($strHost, $strUser, $strPassword, $strDatabase) 
		{
			$this->conn = @fbsql_pconnect($strHost, $strUser, $strPassword) or $this->_DBConnectionError();
			if (!@fbsql_select_db($strDatabase, $this->conn)) {
				$this->Disconnect();
				$this->_DBSelectionError();
			}
			$this->columns = 0;
			$this->rows = 0;
		}
		
		/** Used to disconnect from the current FrontBase database connection.
		 ** @returns void
		 ** @public
		 **/
		function Disconnect() 
		{
			@fbsql_close($this->conn);
			$this->conn = null;
		}
		
		/** Used to execute SQL queries on the currently opened database connection.
		 ** Updates the $columns and $rows variables from the cDBConstruct() class 
		 ** with the values specific to the passed query.  Returns a resource identifier
		 ** on success or false on failure.
		 ** @returns int
		 ** @public
		 **/
		function Query($strSQL) 
		{
			$this->columns = 0;
			$this->rows = 0;
			$rs = @fbsql_query("$strSQL;", $this->conn) or $this->_SQLError($strSQL,$this->GetLastMessage());
			if ($rs > 0) {
				$this->columns = @fbsql_num_fields($rs);
				$this->rows = @fbsql_num_rows($rs);
			}
			return $rs;			
		}
		
		/** Used to get the name of the column specified by $col in the result set identifed by $rs. 
		 ** Returns a string containing the column's name on success an null on failure.
		 ** @returns string
		 ** @public
		 **/
		function ColumnName($rs, $col) 
		{
			if ($rs) return @fbsql_field_name($rs, $col);
		}

		/** Used to get the maximum length that column, $col, from result, $rs, 
		 ** can contain.  Returns the maximum length as an integer on success and
		 ** null on failure.
		 ** @returns int
		 ** @public
		 **/
		function ColumnLength($rs, $col) 
		{
			if ($rs) return @fbsql_field_len($rs, $col);
		}

		/** Used to get the datatype of the column, $col, from result set, $rs, can contain.
		 ** Returns a the datatype as a string on success and null on error.
		 ** @returns string
		 ** @public
		 **/
		function ColumnType($rs, $col) 
		{
			if ($rs) return @fbsql_field_type($rs, $col);
		}

		/** Used to read the current returned row from result result, $rs, into a numerically
		 ** indexed array.  Returns an array containing the row's values indexed by column
		 ** number or success, or false if no further rows exist in the result set.
		 ** can contain.
		 ** @returns array
		 ** @public
		 **/
		function FetchRow($rs,$type=2) 
		{
			if (is_resource($rs)) return @fbsql_fetch_array($rs,$type);
		}
		
		/** Used to get and return the number of rows in the current result set
		 ** can contain.
		 ** @returns int
		 ** @public
		 **/
		function NumRows($rs) 
		{
			if (is_resource($rs)) return @fbsql_num_rows($rs);
		}

		/** Used to switch to the next result set in the case of multiple
		 ** record sets being returned from a stored procedure.  Returns
		 ** true if another result set exists, false if not further result sets 
		 ** are found.  Updates the $columns and $rows variables from 
		 ** the cDBConstruct() class with the new result set's values.
		 ** @returns boolean
		 ** @public
		 **/
		function NextResult($rs) 
		{
			$ret = false;
			if ($rs > 0) {
				if (@fbsql_next_result($rs)) {
					$this->columns = @fbsql_num_fields($rs);
					$this->rows = @fbsql_num_rows($rs);
					$ret = true;
				}
				else {
					$this->columns = 0;
					$this->rows = 0;
					$ret = false;
				}
			}
			return $ret;
		}

		/** Used to free the current result set, $rs, from memory.
		 ** @returns void
		 ** @public
		 **/
		function FreeResult($rs) 
		{
			if ($rs > 0) @fbsql_free_result($rs);
		}

		/** Used to get the text of the most recent error message on the 
		 ** current database connection.  Returns the most recent error message
		 ** as a string if such a message exists.  Otherwise it returns boolean false.
		 ** @returns string
		 ** @public
		 **/
		function GetLastMessage() 
		{
			if ($this->conn) {
				$strError = @fbsql_error($this->conn);
				if ($strError)
					return str_replace("\r\n", "\r", $strError);
				else
					return false;
			}
			else
				return false;
		}
	}

	/** A class used to wrap PHP's PostgreSQL connectivity functions.  While it can be 
	 ** accessed directly, the recommended method is to access it through the wrapper
	 ** cDatabases() class.
	 ** @author Geoff A. Virgo <gvirgo@mithril.ca>
	 **/
	class cPostgreSQL extends cDBConstruct {

		/** The class constructor undertakes no actions beyond returning boolean true.&nbsp;
		 ** It is included merely for good style and against the needs of future expansion.
		 **/
		 function cPostgreSQL() 
		 {
			  $this->cDBConstruct();
		      return true;
		 }
		
		/** This method is used to connect to the specified FrontBase server.  All accepted 
		 ** arguments are strings, with $strDatabase being optional.  If $strDatabase is specified
		 ** the method will try to select that database.
		 ** @returns void
		 ** @public
		 **/
		function Connect($strHost, $strUser, $strPassword, $strDatabase) 
		{
			$this->conn = @pg_pconnect("host=$strHost user=$strUser password=$strPassword dbname=$strDatabase") or $this->_DBConnectionError();
			$this->columns = 0;
			$this->rows = 0;
		}
		
		/** Used to disconnect from the current FrontBase database connection.
		 ** @returns void
		 ** @public
		 **/
		function Disconnect() 
		{
			@pg_close($this->conn);
			$this->conn = null;
		}
		
		/** Used to execute SQL queries on the currently opened database connection.
		 ** Updates the $columns and $rows variables from the cDBConstruct() class 
		 ** with the values specific to the passed query.  Returns a resource identifier
		 ** on success or false on failure.
		 ** @returns int
		 ** @public
		 **/
		function Query($strSQL) 
		{
			$this->columns = 0;
			$this->rows = 0;
			$this->row = 0;
			$rs = @pg_exec($this->conn, $strSQL) or $this->_SQLError($strSQL,$this->GetLastMessage());
			if ($rs > 0) {
				$this->columns = @pg_numfields($rs);
				$this->rows = @pg_numrows($rs);
			}
			return $rs;			
		}
		
		/** Used to get the name of the column specified by $col in the result set identifed by $rs. 
		 ** Returns a string containing the column's name on success an null on failure.
		 ** @returns string
		 ** @public
		 **/
		function ColumnName($rs, $col) 
		{
			if ($rs) return @pg_fieldname($rs, $col);
		}

		/** Used to get the maximum length that column, $col, from result, $rs, 
		 ** can contain.  Returns the maximum length as an integer on success and
		 ** null on failure.
		 ** @returns int
		 ** @public
		 **/
		function ColumnLength($rs, $col) 
		{
			if ($rs) return @pg_fieldsize($rs, $col);
		}

		/** Used to get the datatype of the column, $col, from result set, $rs, can contain.
		 ** Returns a the datatype as a string on success and null on error.
		 ** @returns string
		 ** @public
		 **/
		function ColumnType($rs, $col) 
		{
			if ($rs) return @pg_fieldname($rs, $col);
		}

		/** Used to read the current returned row from result result, $rs, into a numerically
		 ** indexed array.  Returns an array containing the row's values indexed by column
		 ** number or success, or false if no further rows exist in the result set.
		 ** can contain.
		 ** @returns array
		 ** @public
		 **/
		function FetchRow($rs, $type=2) 
		{
			if (is_resource($rs) && $this->row < $this->NumRows($rs)) {
				$num = $this->row;
				$this->row = ($num + 1);
				return pg_fetch_array($rs,$num,$type);
			}
		}
		
		/** Used to get and return the number of rows in the current result set
		 ** can contain.
		 ** @returns int
		 ** @public
		 **/
		function NumRows($rs) 
		{
			if (is_resource($rs)) return @pg_numrows($rs);
		}

		 /** This feature is currently not supported by PostgreSQL and exists merely for consistency 
		  ** within the abstraction layer.  It should be consider deprecated.
		  ** @returns boolean
		  ** @deprecated
		  ** @private
		  **/
		function NextResult($rs) 
		{
			/*
			$ret = false;
			if ($rs > 0) {
				if (@fbsql_next_result($rs)) {
					$this->columns = @fbsql_num_fields($rs);
					$this->rows = @fbsql_num_rows($rs);
					$ret = true;
				}
				else {
					$this->columns = 0;
					$this->rows = 0;
					$ret = false;
				}
			}
			return $ret;
			*/
			return true;
		}

		/** Used to free the current result set, $rs, from memory.
		 ** @returns void
		 ** @public
		 **/
		function FreeResult($rs) 
		{
			if ($rs > 0) @pg_freeresult($rs);
		}

		/** Used to get the text of the most recent error message on the 
		 ** current database connection.  Returns the most recent error message
		 ** as a string if such a message exists.  Otherwise it returns boolean false.
		 ** @returns string
		 ** @public
		 **/
		function GetLastMessage() 
		{
			if ($this->conn) {
				$strError = @pg_errormessage($this->conn);
				if ($strError)
					return str_replace("\r\n", "\r", $strError);
				else
					return false;
			}
			else
				return false;
		}
	}

	/** A class used to wrap PHP's MS-SQL Server connectivity functions.  While it can be 
	 ** accessed directly, the recommended method is to access it through the wrapper
	 ** cDatabases() class.
	 ** @author Frank M. Kromann <frank@frontbase.com>
	 ** @author Geoff A. Virgo <gvirgo@mithril.ca> - internal documentation
	 **/
	class cMSSQL extends cDBConstruct {

		/** The class constructor undertakes no actions beyond returning boolean true.&nbsp;
		 ** It is included merely for good style and against the needs of future expansion.
		 **/
		 function cMSSQL() 
		 {
			  $this->cDBConstruct();
		      return true;
		 }

		/** This method is used to connect to the specified MS SQL server.  All accepted 
		 ** arguments are strings, with $strDatabase being optional.  If $strDatabase is specified
		 ** the method will try to select that database.
		 ** @returns void
		 ** @public
		 **/	
		function Connect($strHost, $strUser, $strPassword, $strDatabase) 
		{
			$this->conn = @mssql_connect($strHost, $strUser, $strPassword) or $this->_DBConnectionError();
			if ($this->conn) {
				@mssql_select_db($strDatabase, $this->conn) or $this->_DBSelectionError();
			}
			@mssql_min_error_severity(100);
			@mssql_min_message_severity(100);
			$this->columns = 0;
			$this->rows = 0;
		}

		/** Used to disconnect from the current FrontBase database connection.
		 ** @returns void
		 ** @public
		 **/	
		function Disconnect() 
		{
			@mssql_close($this->conn);
			$this->conn = null;
		}

		/** Used to execute SQL queries on the currently opened database connection.  
		 ** Updates the $columns and $rows variables from the cDBConstruct() class 
		 ** with the values specific to the passed query.  Returns a resource identifier
		 ** on success or false on failure.
		 ** @returns int
		 ** @public
		 **/		
		function Query($strSQL) 
		{
			$this->columns = 0;
			$this->rows = 0;
			$rs = @mssql_query($strSQL, $this->conn) or $this->_SQLError($strSQL,$this->GetLastMessage());
			if (is_resource($rs)) {
				$this->columns = @mssql_num_fields($rs);
				$this->rows = @mssql_num_rows($rs);
			}
			return $rs;			
		}

		/** Used to get the name of the column specified by $col in the result set identifed by $rs
		 ** Returns a string containing the column's name on success an null on failure.
		 ** @returns string
		 ** @public
		 **/		
		function ColumnName($rs, $col) 
		{
			if ($rs) return @mssql_field_name($rs, $col);
		}

		/** Used to get the maximum length that column, $col, from result, $rs, 
		 ** can contain.  Returns the maximum length as an integer on success and
		 ** null on failure.
		 ** @returns int
		 ** @public
		 **/
		function ColumnLength($rs, $col) 
		{
			if ($rs) return @mssql_field_length($rs, $col);
		}

		/** Used to get the datatype of the column, $col, from result set, $rs, can contain.
		 ** Returns a the datatype as a string on success and null on error.
		 ** @returns string
		 ** @public
		 **/
		function ColumnType($rs, $col) 
		{
			if ($rs) return @mssql_field_type($rs, $col);
		}

		/** Used to read the current returned row from result result, $rs, into a numerically
		 ** indexed array.  Returns an array containing the row's values indexed by column
		 ** number or success, or false if no further rows exist in the result set.
		 ** @returns array
		 ** @public
		 **/		
		function FetchRow($rs,$type=2) 
		{
			if (is_resource($rs)) {
				if ($result = @mssql_fetch_row($rs)) {
					$rowData = array();
					for ($i = 0; $i < $this->columns; $i++) {
						if ($type==1) {
							return $result;
						}
						else if ($type==3) {
							$rowData[] = $result[$i];			
							$rowData[@mssql_field_name($rs, $i)] = $result[$i];
						}
						else {
							$rowData[@mssql_field_name($rs, $i)] = $result[$i];					
						}
					}
				}
			}
			unset($result);
			return $rowData;
		}

		/** Used to get and return the number of rows in the current result set
		 ** can contain.
		 ** @returns int
		 ** @public
		 **/
		function NumRows($rs) 
		{
			if (is_resource($rs)) return @mssql_num_rows($rs);
		}

		/** Used to switch to the next result set in the case of multiple
		 ** record sets being returned from a stored procedure.  Returns
		 ** true if another result set exists, false if not further result sets 
		 ** are found.  Updates the $columns and $rows variables from 
		 ** the cDBConstruct() class with the new result set's values.
		 ** @returns boolean
		 ** @public
		 **/
		function NextResult($rs) 
		{
			$ret = false;
			if (is_resource($rs)) {
				if (@mssql_next_result($rs)) {
					$this->columns = @mssql_num_fields($rs);
					$this->rows = @mssql_num_rows($rs);
					$ret = true;
				}
				else {
					$this->columns = 0;
					$this->rows = 0;
					$ret = false;
				}
			}
			return $ret;
		}

		/** Used to free the current result set, $rs, from memory.
		 ** @returns void
		 ** @public
		 **/
		function FreeResult($rs) 
		{
			if (is_resource($rs)) @mssql_free_result($rs);
		}

		/** Used to get the text of the most recent error message on the 
		 ** current database connection.  Returns the most recent error message
		 ** as a string if such a message exists.  Otherwise it returns boolean false. 
		 ** @returns string
		 ** @public
		 **/
		function GetLastMessage() 
		{
			$strError = @mssql_get_last_message();
			if (trim($strError) != "")
				return str_replace("\r\n", "\r", $strError);
			else
				return false;
		}
	}

	/** A class used to wrap PHP's MS-SQL Server connectivity functions.  While it can be 
	 ** accessed directly, the recommended method is to access it through the wrapper
	 ** cDatabases() class.
	 ** @author Frank M. Kromann <frank@frontbase.com>
	 ** @author Geoff A. Virgo <gvirgo@mithril.ca> - internal documentation
	 **/
	class cODBC extends cDBConstruct {

		/** The class constructor undertakes no actions beyond returning boolean true.&nbsp;
		 ** It is included merely for good style and against the needs of future expansion.
		 **/
		 function cODBC() 
		 {
			  $this->cDBConstruct();
		      return true;
		 }

		/** This method is used to connect to the specified ODBC server or DSN.  All accepted 
		 ** arguments are strings, with $strDatabase being optional.  If $strDatabase is specified
		 ** the method will try to select that database.
		 ** @returns void
		 ** @public
		 **/
		function Connect($strHost, $strUser, $strPassword, $strDatabase) 
		{
			$this->conn = @odbc_connect($strHost, $strUser, $strPassword) or $this->_DBConnectionError();
			$this->columns = 0;
			$this->rows = 0;
		}

		/** Used to disconnect from the current FrontBase database connection.
		 ** @returns void
		 ** @public
		 **/			
		function Disconnect() 
		{
			@odbc_close($this->conn);
			$this->conn = null;
		}

		/** Used to execute SQL queries on the currently opened database connection.  
		 ** Updates the $columns and $rows variables from the cDBConstruct() class 
		 ** with the values specific to the passed query.  Returns a resource identifier
		 ** on success or false on failure.
		 ** @returns int
		 ** @public
		 **/		
		function Query($strSQL) 
		{
			$this->columns = 0;
			$this->rows = 0;
			$rs = @odbc_exec($this->conn, $strSQL) or $this->_SQLError($strSQL,$this->GetLastMessage());
			if ($rs) {
				$this->columns = @odbc_num_fields($rs);
				$this->rows = @odbc_num_rows($rs);
			}
			return $rs;			
		}

		/** Used to get the name of the column specified by $col in the result set identifed by $rs. 
		 ** Returns a string containing the column's name on success an null on failure.
		 ** @returns string
		 ** @public
		 **/	
		function ColumnName($rs, $col) 
		{
			if ($rs) return @odbc_field_name($rs, $col + 1);
		}

		/** Used to get the maximum length that column, $col, from result, $rs, 
		 ** can contain.  Returns the maximum length as an integer on success 
		 ** and null on failure.
		 ** @returns int
		 ** @public
		 **/
		function ColumnLength($rs, $col) 
		{
			if ($rs) return @odbc_field_len($rs, $col + 1);
		}

		/** Used to get the datatype of the column, $col, from result set, $rs, can contain.
		 ** Returns a the datatype as a string on success and null on error.
		 ** @returns string
		 ** @public
		 **/
		function ColumnType($rs, $col) 
		{
			if ($rs) return @odbc_field_type($rs, $col + 1);
		}

		/** Used to read the current returned row from result result, $rs, into a numerically
		 ** indexed array.  Returns an array containing the row's values indexed by column
		 ** number or success, or false if no further rows exist in the result set.
		 ** @returns array
		 ** @public
		 **/		
		function FetchRow($rs,$type=2) 
		{
			$rowData = array();
			if (is_resource($rs)) {
				if (@odbc_fetch_row($rs)) {
					for ($i = 0; $i < $this->columns; $i++) {
						if ($type==1) {
							$rowData[@odbc_field_name($rs, $i + 1)] = @odbc_result($rs, $i + 1);
						}
						else if ($type==3) {
							$result = @odbc_result($rs, $i + 1);
							$rowData[@odbc_field_name($rs, $i + 1)] = $result;
							$rowData[] = $result;
						}
						else {
							$rowData[] = @odbc_result($rs, $i + 1);
						}
					}
				}
			}
			unset($key);
			unset($result);
			return $rowData;
		}

		/** Used to get and return the number of rows in the current result set
		 ** can contain.
		 ** @returns int
		 ** @public
		 **/
		function NumRows($rs) 
		{
			if (is_resource($rs)) return @odbc_num_rows($rs);
		}

		/** This function is currently not supported in PHP's Unified ODBC Functions and 
		 ** exists merely for consistency within the abstraction layer.  It should be 
		 ** consider deprecated.
		 ** @returns boolean
		 ** @deprecated
		 ** @private
		 **/
		function NextResult($rs) 
		{
			$ret = true;
			/*
			$ret = false;
			if ($rs) {
				if (@odbc_next_result($rs)) {
					$this->columns = @odbc_num_fields($rs);
					$this->rows = @odbc_num_rows($rs);
					$ret = true;
				}
				else {
					$this->columns = 0;
					$this->rows = 0;
					$ret = false;
				}
			}
			*/
			return $ret;
		}

		/** Used to free the current result set, $rs, from memory.
		 ** @returns void
		 ** @public
		 **/
		function FreeResult($rs) 
		{
			if ($rs) @odbc_free_result($rs);
		}

		/** Used to get the text of the most recent error message on the 
		 ** current database connection.  Returns the most recent error message
		 ** as a string if such a message exists.  Otherwise it returns boolean false.
		 ** @returns string
		 ** @public
		 **/
		function GetLastMessage() 
		{
			if ($this->conn) {
				$strError = @odbc_error($this->conn);
				if ($strError)
					return str_replace("\r\n", "\r", $strError);
				else
					return false;
			}
			else
				return false;
		}
	}

	/** A class used to wrap PHP's mySQL connectivity functions.  While it can be 
	 ** accessed directly, the recommended method is to access it through the wrapper
	 ** cDatabases() class.
	 ** @author Geoff A. Virgo <gvirgo@mithril.ca>
	 **/
	class cMYSQL extends cDBConstruct {

		/** The class constructor undertakes no actions beyond returning boolean true.&nbsp;
		 ** It is included merely for good style and against the needs of future expansion.
		 **/
		 function cMYSQL() 
		 {
			  $this->cDBConstruct();
		      return true;
		 }

		/** This method is used to connect to the specified mySQL server.  All accepted 
		 ** arguments are strings.
		 ** @returns void
		 ** @public
		 **/
		function Connect($strHost, $strUser, $strPassword, $strDatabase) 
		{
			$this->conn = @mysql_connect($strHost, $strUser, $strPassword) or $this->_DBConnectionError();
			if (!@mysql_select_db($strDatabase, $this->conn)) {
				$this->Disconnect();
				$this->_DBSelectionError();
			}
			$this->columns = 0;
			$this->rows = 0;
		}

		/** Used to disconnect from the current FrontBase database connection.
		 ** @returns void
		 ** @public
		 **/		
		function Disconnect() 
		{
			@mysql_close($this->conn);
			$this->conn = null;
		}

		###########################################
		# Function:    Select
		# Parameters:  sql : string
		# Return Type: array
		# Description: executes a SELECT statement and returns a
		#              multidimensional array containing the results
		#              array[row][fieldname/fieldindex]
		###########################################
		function Select($strSQL)	{
			if ((empty($strSQL)) || (!eregi("^select",$strSQL))) {
		      $this->_SQLError($strSQL,$this->GetLastMessage());
		      return false;
		    } else {
		  	  $results = mysql_query($strSQL);
			  if ((!$results) || (empty($results))) {
			$this->_SQLError($strSQL,$this->GetLastMessage());
			return false;
		      } else {
			$i = 0;
			$data = array();
			while ($row = mysql_fetch_array($results)) {
				$data[$i] = $row;
				$i++;
			}
			mysql_free_result($results);
			return $data;
		      }
		    }
		}

		/** Used to execute SQL queries on the currently opened database connection.  
		 ** Updates the $columns and $rows variables from the cDBConstruct() class 
		 ** with the values specific to the passed query.  Returns a resource identifier
		 ** on success or false on failure.
		 ** @returns int
		 ** @public
		 **/
		function Query($strSQL) 
		{ 
			$this->columns = 0;
			$this->rows = 0;
			$rs = @mysql_query($strSQL) or $this->_SQLError($strSQL,$this->GetLastMessage());
             
			if (is_resource($rs)) {
				$this->columns = @mysql_num_fields($rs);
				$this->rows = @mysql_num_rows($rs);
			}
			return $rs;			
		}

		/** Used to get the name of the column specified by $col in the result set identifed by $rs. 
		 ** Returns a string containing the column's name on success an null on failure.
		 ** @returns string
		 ** @public
		 **/
		function ColumnName($rs, $col) 
		{
			if (is_resource($rs)) return @mysql_field_name($rs, intval($col));
		}

		/** Used to get the maximum length that column, $col, from result, $rs, 
		 ** can contain.  Returns the maximum length as an integer.
		 ** @returns int
		 ** @public
		 **/
		function ColumnLength($rs, $col) 
		{
			if (is_resource($rs)) return @@mysql_field_len($rs, intval($col));
		}

		/** Used to get the datatype of the column, $col, from result set, $rs, can contain.
		 ** Returns a the datatype as a string on success and null on error.
		 ** @returns string
		 ** @public
		 **/
		function ColumnType($rs, $col) 
		{
			if (is_resource($rs)) return @@mysql_field_type($rs, intval($col));
		}

		/** Used to read the current returned row from result result, $rs, into a numerically
		 ** indexed array.  Returns an array containing the row's values indexed by column
		 ** number or success, or false if no further rows exist in the result set.
		 ** @returns array
		 ** @public
		 **/		
		function FetchRow($rs,$type=MYSQL_BOTH) 
		{
			if (is_resource($rs)) {return @mysql_fetch_array($rs);
			
			
			}
		}

		/** Used to get and return the number of rows in the current result set
		 ** can contain.
		 ** @returns int
		 ** @public
		 **/
		function NumRows($rs) 
		{
			if (is_resource($rs)) return @mysql_num_rows($rs);
		}

		 /** This feature is currently not supported by mySQL and exists merely for consistency 
		  ** within the abstraction layer.  It should be consider deprecated.
		  ** @returns boolean
		  ** @deprecated
		  ** @private
		  **/
		function NextResult($rs) 
		{
			/*
			$ret = false;
			if ($rs) {
				if (@mysql_next_result($rs)) {
					$this->columns = @mysql_num_fields($rs);
					$this->rows = @mysql_num_rows($rs);
					$ret = true;
				}
				else {
					$this->columns = 0;
					$this->rows = 0;
					$ret = false;
				}
			}
			return $ret;
			*/
			return true;
		}

		/** Used to free the current result set, $rs, from memory.
		 ** @returns void
		 ** @public
		 **/
		function FreeResult($rs) 
		{
			if ($rs) @mysql_free_result($rs);
		}

		/** Used to get the text of the most recent error message on the 
		 ** current database connection.  Returns the most recent error message
		 ** as a string if such a message exists.  Otherwise it returns boolean false.
		 ** @returns string
		 ** @public
		 **/
		function GetLastMessage() 
		{
			if ($this->conn) {
				$strError = @mysql_error($this->conn);
				if ($strError)
					return str_replace("\r\n", "\r", $strError);
				else
					return false;
			}
			else
				return false;
		}




	}

	/**
	 ** This is a wrapper class used to provide a common access interface for all
	 ** the RDBMS specific classes.  Use this classes methods to set and/or retrieve
	 ** a database object.  The actual database operations are performed by using
	 ** methods detailed in the cFrontBase(), cMSSQL, cODBC(), and cMYSQL classes.
	 ** @author Frank M. Kromann <frank@frontbasec.com>
	 ** @author Geoff A. Virgo <gvirgo@mithril.ca> - internal documentation and minor revisions
	 */
	class cDatabases {

		/** This variable is array of the objects created for the various databases suuported
		 ** by this abstraction layer.  The array uses associative keys, named after the 
		 ** databases in question, to store the object.  Currently supported index names  
		 ** are:
		 ** FRONTBASE
		 ** MSSQL
		 ** ODBC
		 ** MYSQL
		 **@type array 
		*/
		var $databaseTypes;

		/** This variable is used to store the internal object of the currently selected 
		 ** database.  It is intended for internal use by member methods of any classes
		 ** you may write which extend this class.  The get() method should be used for
		 ** external script access.
		 **@type obj 
		*/
		var $currentDB;
		
		/** The class contructor checks to see whether FrontBase, MS SQL Server,
		 ** ODBC, and mySQL support is enabled in PHP then creates, registers and stores
		 ** objects for any of the above databases supported.
		 ** @private
		 ** @returns void
		 **/
		function cDatabases() 
		{
			$this->databaseTypes = array();
			$this->currentDB = null;

			if (extension_loaded("fbsql")) {
				$db = new cFrontBase();
				$this->Register("FRONTBASE", $db);
			}

			if (extension_loaded("pgsql")) {
				$db = new cPostgreSQL();
				$this->Register("POSTGRES", $db);
			}

			if (extension_loaded("mssql")) {			
				$db = new cMSSQL();
				$this->Register("MSSQL", $db);
			}

			if (extension_loaded("odbc")) {
				$db = new cODBC();
				$this->Register("ODBC", $db);
			}

			if (extension_loaded("mysql")) {
				$db = new cMYSQL();
				$this->Register("MYSQL", $db);
			}
		}
		
		/** The _register method is called by the constructor during the
		 ** class instantiation.  It is used to create instances of the database
		 ** specific classes, and register those objects with the $databaseTypes 
		 ** array used to store those objects.  There is no need to ever call 
		 ** this function directly.
		 ** @private
		 ** @returns void
		 **/
		function Register($type, $handler)
		{
			$this->databaseTypes[$type] = $handler;
		}
		
		/** The get method is used to retrieve and return the object for the 
		 ** database you desire to use.  It also sets the variables which stores
		 ** the currently selected database object internally.
		 ** @public
		 ** @returns obj
		 **/
		function &Get($type, $set = 0)
		{
			if ($set == 1)
				$this->Set($type);
			return $this->databaseTypes[strtoupper($type)];
		}

		/** The set method is used to set the select the database specified by $type without returning 
		 ** an object variable.  It is intended to be used by classes which extend the cDatabases() and
		 ** where creating a new object variable would have little or negative impact on the programs 
		 ** performance.
		 ** @public
		 ** @returns void
		 **/
		function &Set($type)
		{
			$this->currentDB = $this->databaseTypes[strtoupper($type)];
		}
		/** This method is used to connect to the specified server.  All accepted 
		 ** arguments are strings.
		 ** @returns void
		 ** @public
		 **/
		function Connect($strHost, $strUser, $strPassword, $strDatabase) 
		{
			return $this->currentDB->Connect($strHost, $strUser, $strPassword, $strDatabase);
		}

		/** Used to disconnect the current database connection.
		 ** @returns void
		 ** @public
		 **/		
		function Disconnect() 
		{
			$this->currentDB->Disconnect();
		}

		function Select($strSQL)
		{
			return $this->currentDB->Select($strSQL);	
		}


		/** Used to execute SQL queries on the currently opened database connection.  
		 ** Updates the $columns and $rows variables from the cDBConstruct() class 
		 ** with the values specific to the passed query.  Returns a resource identifier
		 ** on success or false on failure.
		 ** @returns int
		 ** @public
		 **/
		function Query($strSQL) 
		{
			return $this->currentDB->Query($strSQL);			
		}

		/** Used to get the name of the column specified by $col in the result set identifed by $rs. 
		 ** Returns a string containing the column's name on success an null on failure.
		 ** @returns string
		 ** @public
		 **/
		function ColumnName($rs, $col) 
		{
			return $this->currentDB->ColumnName($rs, $col);
		}

		/** Used to get the maximum length that column, $col, from result, $rs, 
		 ** can contain.  Returns the maximum length as an integer.
		 ** @returns int
		 ** @public
		 **/
		function ColumnLength($rs, $col) 
		{
			return $this->currentDB->ColumnLength($rs, $col);
		}

		/** Used to get the datatype of the column, $col, from result set, $rs, can contain.
		 ** Returns a the datatype as a string on success and null on error.
		 ** @returns string
		 ** @public
		 **/
		function ColumnType($rs, $col) 
		{
			return $this->currentDB->ColumnType($rs,$col);
		}

		/** Used to read the current returned row from result result, $rs, into a numerically
		 ** indexed array.  Returns an array containing the row's values indexed by column
		 ** number or success, or false if no further rows exist in the result set.
		 ** @returns array
		 ** @public
		 **/		
		function FetchRow($rs,$type=2) 
		{
			return $this->currentDB->FetchRow($rs,$type);
		}

		/** Used to get and return the number of rows in the current result set
		 ** can contain.
		 ** @returns int
		 ** @public
		 **/
		function NumRows($rs) 
		{
			return $this->currentDB->NumRows($rs);
		}

		 /** This feature is currently not supported by mySQL and exists merely for consistency 
		  ** within the abstraction layer.  It should be consider deprecated.
		  ** @returns boolean
		  ** @deprecated
		  ** @private
		  **/
		function NextResult($rs) 
		{
			return $this->currentDB->NextResult($rs);
		}

		/** Used to free the current result set, $rs, from memory.
		 ** @returns void
		 ** @public
		 **/
		function FreeResult($rs) 
		{
			 $this->currentDB->FreeResult($rs);
		}

		/** Used to get the text of the most recent error message on the 
		 ** current database connection.  Returns the most recent error message
		 ** as a string if such a message exists.  Otherwise it returns boolean false.
		 ** @returns string
		 ** @public
		 **/
		function GetLastMessage() 
		{
			return $this->currentDB->GetLastMessage();
		}
	}

?>