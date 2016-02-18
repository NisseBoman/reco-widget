# Wordpress Reco-widget

## Description

Reco is a swedish consumer site where consumers recommend companies to other consumers by giving 'recos'. Notice that the plugin is in Swedish only right now as reco.se only are in Swedish anyway.

This repo is based on an existing repo that have gone stale [github page](https://github.com/Angrycreative/reco-widget)

## Contributors
- plux
- angrycreative
- wilsoncreative
- nisse@tnfgruppen.com

## Installation

This section describes how to install the plugin and get it working.

1. Upload all files to the `/wp-content/plugins/reco-widget` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Add the CompanyId and API key via the settings menu in wordpress. (Information you get form Reco.se)
1. Place the shortcode `[reco-widget]` where you want to place it.

## Usage
This plugin uses a shortcode "[reco-widget]" so that you can show a widget with recos for your company,
but you must contact reco.se to be able to use this plugin as it requires a "company id" and a "API-Key".

Availeble attributes to the shortcode is

- [reco-widget limit="val"] will override the global limit in the options pane
- [reco-widget from="YYYY-mm-dd" to="YYYY-mm-dd"] show's only reco's between the written dates
- [reco-widget employeeid="val"] Show only reco from the selected employeeid. The id is something you need to find via the API..
- [reco-widget last-days="5"] Show only recos from the last num-days.
You might wanna change some of the css and the HTML code output in the file `reco-widget.php` for the styling and look you want.

### Examples sites are
- [www.salongmajo.se](http://www.salongmajo.se/)
- [www.verisure.se/](http://www.verisure.se/)
You can get more information from you contact at [Reco.se](http://www.reco.se)

## TODO
- [x] Add employeeid as filter
- [x] Add random reco's fuction to randomize the reco's shown
- [ ] Add feature multiple employeeid's
- [ ] Create some sort of local cache to avoid the site to break if the API is unavaileble.
- [ ] Layout handling in a less hardcoded way. Maby with other shortcodes but not sure how.

## Changelog

### 0.2
 - Added shortcode 'last-days' to only get recos for the num-last days. This overrides the to & form filter
 - removed some dev ouput in the error_log

### 0.1
- Initial version.
- Fixed issues with old widget and new API from reco
- Added shortcode attributes for emplyeeId, to & from filter
- Random reviews
