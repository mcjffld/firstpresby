#!/usr/bin/perl

use Net::FTP;


my $vlc = qq{"C:/Program Files (x86)/VideoLAN/VLC/vlc"};

my $audacity = qq{"C:/Program Files (x86)/Audacity/audacity"};

my $source = "cdda:///d:/";

my $tempDir = "/Sermons";

chdir $tempDir;

my $ONEDAY = 24 * 60 * 60;

my $sermonTime = time;

$sermonTime += $ONEDAY;

($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime($sermonTime);

while($wday > 0) {
        $sermonTime -= $ONEDAY;
        ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime($sermonTime);
}
$mon++;
$year+=1900;

my $target =  sprintf("%04d%02d%02d-sermon.wav",$year,$mon,$mday);

my $vlcCommand = qq{ -I dummy --no-sout-video --sout-audio --no-sout-rtp-sap --no-sout-standard-sap --ttl=1 --sout-keep --sout "#transcode{acodec=s16l,channels=2}:std{access=file,mux=wav,dst=$target}"  $source  vlc://quit};

print "Executing $vlc $vlcCommand";

print `$vlc $vlcCommand`;

print "\n\nDone getting file from CD\n\nOpening Audacity to edit audio ...\n\n";

print "$audacity $target\n";

print `$audacity $target`;

my $mp3file = $target;

$mp3file =~ tr/.wav/.mp3/;

die "Can't find MP3 file: $mp3file" unless (-f $mp3file);

my $host = "firstpresby.net";

print "Connecting to $host ...\n";

$ftp = Net::FTP->new("firstpresby.net", Debug => 0) or die "Cannot connect to some.host.name: $@";

$ftp->login("firstpresby",'Duffy2014!!') or die "Cannot login ", $ftp->message;

$ftp->binary;

$ftp->cwd("/sermons") or die "Cannot change working directory ", $ftp->message;

$ftp->hash(1,1024*1024);

my @files = $ftp->dir();

my $lastFile;
my %r = {};
my %l = {};


foreach my $file (@files) {
	my @data = split(" ",$file);
	my $size = $data[4];
	my $filename = $data[8];
	$r{$filename} = $size;
}



opendir(DIR,".");

@files = readdir(DIR);

foreach my $file (@files) {
	next unless $file =~ /mp3$/;

	$l{$file} = -s $file;

	if ($l{$file} == $r{$file}) {
#		print "Found a match for $file\n";
	} else {
#		print "Found a problem for $file\n";

		print "Sending $file to http://firstpresby.net/sermons/$file ...\n";

		$ftp->put($file) or print "had a problem ... ", $ftp->message;

		$lastFile = $file;

	}
}

$ftp->quit;

print "Done\n\n";

if ($lastFile) {
`/PROGRA~2/Google/Chrome/APPLIC~1/chrome.exe http://firstpresby.net/sermons/$lastFile`;
}
print "Hit Enter to exit ...\n\n";

<>;
