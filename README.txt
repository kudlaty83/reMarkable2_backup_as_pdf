This is my effort to backup all documents made on reMarkable 2 e-ink tablet as PDF files (with full directory structure).

This code was tested under Linux (Linux Mint 21.2), and for me it is working. At this moment it needs php (for example php-cli) and php-json module. 
There is a lot of work to make the job good. There is no check if names of dirs, and documents don't contains special characters. There is no test if device is accesible, no error checks, ect.
I think there is possible to make some damage of files on Your computer  if something (file or directory) on reMarkabe have  milicious names or content.
When You have lot of files on reMarkable, test if this job is not to hard for your tablet (conversion is made directly on reMarkable device, and uses 100% CPU, so possibly can produce a lot of heat)

Script works under console

Sorry for my english ;)

And Yes - You are right, probably PHP is not good choice for this job.
Some other projects, making different types of backup You can find there:

- Backups:
https://github.com/kwoot/backup_reMarkable
https://github.com/SimplyKyra/SimplyKyraBlog/tree/main

- Conversion .rm files to other formats:
https://github.com/ricklupton/rmc/


