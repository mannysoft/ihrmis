<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_ftp extends CI_Ftp{

    function index()
	{
	
	}
	
	function download($filename)
    {
		if ( ! $this->_is_conn())
		{
			return FALSE;
		}
		
		
		//$remote_file = '/public_html/updates/files/'.$filename;
		$remote_file = '/files/'.$filename;
		$local_file = 'updates/'.$filename;
		
		// open some file to write to
		$handle = fopen($local_file, 'w');
		
		// try to download $remote_file and save it to $handle
		if (ftp_get($this->conn_id, $local_file, $remote_file, FTP_BINARY)) 
		{
		 	//echo "ok";
		} 
		else 
		{
		 echo "There was a problem while downloading $filename";
		}
		//echo 'ok';
		
		// close the connection and the file handler
		//ftp_close($conn_id);
		fclose($handle);
    }
	

	function smart_copy($source, $dest, $folderPermission=0755,$filePermission=0644){
	# source=file & dest=dir => copy file from source-dir to dest-dir
	# source=file & dest=file / not there yet => copy file from source-dir to dest and overwrite a file there, if present
	
	# source=dir & dest=dir => copy all content from source to dir
	# source=dir & dest not there yet => copy all content from source to a, yet to be created, dest-dir
		$result=false;
	   
		if (is_file($source)) { # $source is file
			if(is_dir($dest)) { # $dest is folder
				if ($dest[strlen($dest)-1]!='/') # add '/' if necessary
					$__dest=$dest."/";
				$__dest .= basename($source);
				}
			else { # $dest is (new) filename
				$__dest=$dest;
				}
			$result=copy($source, $__dest);
			chmod($__dest,$filePermission);
			}
		elseif(is_dir($source)) { # $source is dir
			if(!is_dir($dest)) { # dest-dir not there yet, create it
				@mkdir($dest,$folderPermission);
				chmod($dest,$folderPermission);
				}
			if ($source[strlen($source)-1]!='/') # add '/' if necessary
				$source=$source."/";
			if ($dest[strlen($dest)-1]!='/') # add '/' if necessary
				$dest=$dest."/";
	
			# find all elements in $source
			$result = true; # in case this dir is empty it would otherwise return false
			$dirHandle=opendir($source);
			while($file=readdir($dirHandle)) { # note that $file can also be a folder
				if($file!="." && $file!="..") { # filter starting elements and pass the rest to this function again
	#                echo "$source$file ||| $dest$file<br />\n";
					$result=$this->smart_copy($source.$file, $dest.$file, $folderPermission, $filePermission);
					}
				}
			closedir($dirHandle);
			}
		else {
			$result=false;
			}
		return $result;
		}
		
		
		//smart_copy('a/', 'b/', $folderPermission=0755,$filePermission=0644);
}

?>