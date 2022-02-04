# yt-dlp-podcast
Scrape audio from youtube and serve as a podcast.
This uses [yt-dlp] (https://github.com/yt-dlp/yt-dlp) to the hard work.  The result is then served as a podcast.
Forked from alnixon (https://github.com/alnixon/youtube-dl-podcast)

## Setup
A subdirectory caled **data** needs to be created with write permission for the user that will run the shell script.

The following files coordinate the downloading of audio
* **yt-dlp.sh (linux)**
  * This needs to be scheduled to run with cron every 24hrs.
  * Line 44/43 of this file will need to be changed to your path.
  * Initially 1 month of files will be downloaded - this can be changed on line 43/42.
  * Files will be kept for 60 days - this can be changed on line 53/56

* **channels.txt**
List the youtube channels to download here, one per line.
* **downloaded.txt**
This is used to track what has already been downloaded.

## Usage
Simply point your podcast client at the location this is hosted at.

## Contributing
I knocked this together *very* quickly for my own needs.  I welcome improvements via pull requests.
