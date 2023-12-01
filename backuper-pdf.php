<?php
/*
MIT License

Copyright (c) 2023 Marcin Błaszczak

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

/*
This code was tested under Linux (Linux Mint 21.2). At this moment You need php (for example php-cli) and php-json module. 
There is a lot of work to make the job completed. There is no check if names of dirs, and documents don't contains special characters. There is no test if device is accesible, no error checks, ect.
I think there is possible to make some damage of files on Your computer  if something (file or directory) on reMarkabe have  milicious names or content.
When You have lot of files on reMarkable, test if this job is not to hard for your tablet (conversion is made directly on reMarkable device, and uses 100% CPU, so possibly can produce a lot of heat)

Sorry for my english ;)

Script works under console
*/

function scan_and_download($download_url, $scan_url, $save_path)
{
	if(!is_dir($save_path)) mkdir($save_path);
	$jobs=json_decode(file_get_contents($scan_url));
	//echo($scan_url."\n");
	//print_r($jobs);
	foreach($jobs as $j)
	{
		//check if is it directory, and if necessary recurrency call scan_and_download function
		if(isset($j->Type) && $j->Type=='CollectionType') 
		{
			echo("Directory: ".$j->VissibleName."\n");
			scan_and_download($download_url, $scan_url.$j->ID.'/', $save_path.'/'.$j->VissibleName);
		}
		elseif(isset($j->Type) && $j->Type=='DocumentType')
		{
			echo("Downloading file: ".$j->VissibleName."\n");
			$content_pdf=file_get_contents($download_url.$j->ID.'/placeholder');
			file_put_contents($save_path.'/'.$j->VissibleName.'.pdf', $content_pdf);
			//let the CPU of reMarkable to breathe a while 
			sleep(10);
		}
	}

}

// Basic variables
$ip_addr='10.11.99.1';
$download_url='http://'.$ip_addr.'/download/';
$scan_url='http://'.$ip_addr.'/documents/';
$save_path='./backup_pdf/'.date('Y-m-d');
if(!is_dir('./backup_pdf')) mkdir('./backup_pdf');

scan_and_download($download_url, $scan_url, $save_path);

?>
