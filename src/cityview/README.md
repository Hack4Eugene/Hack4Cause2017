# CityView data dashboard

This repo is for the 2017 Hack for a cause City of Eugene Data Dashboard challenge.

To install and work on this repo you need to create python virtualenv using python3.5,
checkout this repo to a directory on your local machine. And then run
`pip install -r requirements.txt` followed by `jupyter notebook notebooks/`

Team Members:

Ellwood Zwovic

Heron Navarro

Max Skorodinsky

Dylan Heine

Larry Price laprice@gmail.com

We used the following tools:
   LeafletJS for the mapping component.
   Plain old javascript for the additional styling and behavior.
   Jupyter notebooks for data intake and analysis.
   PostGIS database for wrangling the geographic data.

A copy of the project is visible at https://cityview.hour.li

Built with data sourced from the City of Eugene

Technology:

  LeafletJS for the mapping component.
  Plain old javascript for the additional styling and behavior.
  Jupyter notebooks for data intake and analysis.
  PostGIS database for wrangling the geographic data.


Story:

We envision this as a website that folks would visit to see what's happening in Eugene from multiple curiosity perspectives:

1.  How is Eugene changing over time - building permits tab:
  - where is residential and commercial development happening (based on visualizing building permits)
  - where are city parks that are under consideration (phase 2 and beyound, based on city data)
  - where are new/updated school projects (phase 2)
  - we envision lots of other possibilities here:

2.  What is the parking situation and parking meter activity in the city - parking tab:
   - where are parking ticket issued and how is this changing over time
   - how is this changing over time (phase 2 - a timeline slider that allows users to see data corresponding to a perticular time)

3.  What are current spending priorities for city governennce:
    - showing current street repair projects
    - showing upcoming street repair projects
	    - many things could be presented visually here, given data from the city that we can massage into GIS coordinates