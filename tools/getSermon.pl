#!/usr/bin/perl

my $vlc = qq{/Applications/VLC.app/Contents/MacOS/VLC};

my $audacity = qq{/Applications/Audacity/Audacity.app/Contents/MacOS/Audacity};

my $source = "cdda:///dev/rdisk1";

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

#print `$vlc $vlcCommand`;

print "\n\nDone getting file from CD\n\nOpening Audacity to edit audio ...\n\n";

print "$audacity $target\n";

print `$audacity $target`;





