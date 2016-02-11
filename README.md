# Wordpress Reco-widget

## Description

Reco is a swedish consumer site where consumers recommend companies to other consumers by giving 'recos'. Notice that the plugin is in Swedish only right now as reco.se only are in Swedish anyway.

All development will be done over at our [github page](https://github.com/NisseBoman/reco-widget)

## Contributors
- plux
- angrycreative
- wilsoncreative
- nisse@tnfgruppen.com

## Installation

This section describes how to install the plugin and get it working.

e.g.

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place the shortcode `[reco-widget]` where you want to place it.

## Usage
This plugin uses a shortcode "[reco-widget]" so that you can show a widget with recos for your company,
but you must contact reco.se to be able to use this plugin as it requires a "company id" and a "API-Key".

Availeble attributes to the shortcode is

- [reco-widget limit="val"] will override the global limit in the options pane
- [reco-widget from="YYYY-mm-dd" to="YYYY-mm-dd"] show's only reco's between the written dates
- [reco-widget employeeid="val"] Show only reco from the selected employeeid. The id is something you need to find via the API..

## TODO
- [x] Add employeeid as filter
- [ ] Add random reco's fuction to randomize the reco's shown
- [ ] Add feature multiple employeeid's
- [ ] Create some sort of local cache to avoid the site to break if the API is unavaileble.

## Changelog

### 0.1
- Initial version.
- Fixed issues with old widget and new API from reco
- Added shortcode attributes for emplyeeId, to & from filter
- TODO: Add more filters like random and multiple employeeid's
