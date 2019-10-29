# PROFIT CMS developer's documentation


> Author: Valentin Belousov valentin@profit.az
>
> Version: 6.2.2
>
> Date: 2017-06-02


## Contents


1. [Contents](#markdown-header-contents)
2. [Introduction](#markdown-header-introduction)
	1. [Getting started](#markdown-header-getting-started)
	2. [Files structure](#markdown-header-files-structure)
	3. Architecture
	4. Roles and rights management
3. CMS pages description
	1. Login page
	2. Restore password page

	
## Introduction


### Getting started


Before getting started it is highly recommended to get familiar with `README.md` with basic overview of CMS. It will help you deploy your local copy of CMS.  
Modify configs and you are ready to go.


### Files structure


Files structure is compliant to PSR-4 standart. Despite presence of `vendor` directory there is no composer installation supported.

	app
		config
		controllers
		helpers
		langs
		models
		views
	vendor
		profit_az
			profit_cms
				base
				db_adapters
				helpers
	web
		css
		fonts
		images
		js