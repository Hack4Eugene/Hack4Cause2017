# Hack for a Cause2017 - Team UrbanInsight

### Overview

To address the "Eugene Community Dashboard" challenge, we utilized the latest web technology to build this prototype dashboard. The first feature of this dashboard are **meters** displaying key statistics such as population, crime rate, employment, and more. These meters aim to give a simple and clear message to viewers, but detailed graphs of subsets of data or a time course graph can be displayed when they click on a meter. Our dashboard also features an **interactive map** of different Eugene neighborhoods, when hovering over each neighborhood key statistics can be displayed on the map. Potential additional features include a community calendar, more chart and graph types that are interactive and allow people to explore different analyses of available municipal data.

#### Team Members

-	Dan Keith:      dan@quantumclay.com
-	Lan Guo:        lan.guo14@gmail.com

### User Understanding

Our understanding of our target user (as opposed to the challenge stakeholders) is that they may be Eugene residents like us, or they may be interested in understanding Eugene's story for purposes of considering moving or doing business here. So our focus was on making visible important aspects such as Livability, Transportation, Education and so on. We wanted to provide insight.


### Technical Approach

Our goals were to deliver a working, sustainable and extensible dashboard platform and to populate it with some of the data provided by the stakeholders for this challenge. We concentrated primarily on creating a compelling dashboard experience that we believe can be extended by the stakeholders if they choose to continue the project.

We chose to adopt a modern, *serverless* architecture, which is more scalable and easier to deploy and extend than relying upon custom server code. This means that the web application we developed can be easily deployed via most web site mechanisms. For example, we use GitHub Pages to serve up our example at: [Urban Insight Site](http://urbaninsight.site).

### Data used


### Things we accomplished and left undone

We incorporated the shapefiles of the Eugene neighborhoods and their year 2000 population into one of our maps.

We wanted to build some time-series graphs from the year 2000-2012 property data, and tie this in the with map. But we ran out of time.


### Technology Used

We spent some time evaluating various free and MIT-licensed dashboard templates and examples. We chose to use [ng2-admin](https://akveo.github.io/ng2-admin/), a very flexible and sustainable admin dashboard framework based on Angular 2, Bootstrap 4 and Webpack.


#### Features


* Serverless: this dashboard runs on github pages so you don't have to worry about a server
* Scalable: it's straightforward to add more features/data
* Responsive:

#### Tech Stack

* TypeScript
* Webpack
* Responsive layout
* High resolution
* Bootstrap 4 CSS Framework
* Sass
* Angular 2
* jQuery
* Charts (Chartist, Chart.js)
* Maps (Google, Leaflet, amMap)
* and many more!

#### Installation for Development

Detailed information and help on using the **ng2-admin** framework can be found at [https://akveo.github.io/ng2-admin/](https://akveo.github.io/ng2-admin/). The Quickstart below covers the basics.

#### Quickstart

##### Clone the GitHub repo:
```
 git clone https://github.com/Hack4Eugene/Hack4Cause2017/
```

##### Move to the correct team directory:
```
cd src/urban-insight/
```

##### Install NPM Modules

```
npm install
```

##### Run the Development Server

```
npm run server
```

##### Prepare a Static Site for Deployment

To compile and bundle the web application for deployment, you will use the `build` command to create a set of assets in the `/docs` subdirectory:

```
npm run build
```


