# preflight.sh
#!/usr/bin/bash

if [ "$#" -ne "1" ] 
then
    echo "Usage: ./preflight.sh <appname>"
    echo "<appname> is either PAN or REP"
    exit;
fi

rm -r static/
rm -r templates/

mkdir static
mkdir templates

if [ $1 == "PAN" ] 
then
    cp DonationApp/app.py flask_app.py
    cp -R DonationApp/static .
    cp -R DonationApp/templates .
    exit;
fi

if [ $1 == "REP" ] 
then
    cp CommunityReportsApp/flask_app.py flask_app.py
    cp -r CommunityReportsApp/static .
    cp -r CommunityReportsApp/templates .
    python3 testDB.py
    exit;
fi