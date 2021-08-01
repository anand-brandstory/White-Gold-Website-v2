##### [Version 4.5.3](https://github.com/Codeinwp/WP-Cloudflare-Super-Page-Cache/compare/v4.5.2...v4.5.3) (2021-05-25)

- Fixing a bug related to CRON job
- Fixing a bug related to not loading the admin pages properly when AMP plugin is installed and Standard mode is selected
- Getting rid of Cloudflare __cfid cookie check as Cloudflare has deprecated it
- Making sure Sweetalerat is loaded locally instead of jsdeliver & also proper version number is mention in the code
- Updating sweetalert to v11.0.5
- Fixing a minor bug in backend.js related to a page reload upon activation of page caching
- Adding proper wp rocket filters to disable WP Rocket page caching when using this plugin. The previously documented filter is deprecated.

##### [Version 4.5.2](https://github.com/Codeinwp/WP-Cloudflare-Super-Page-Cache/compare/v4.5.1...v4.5.2) (2021-05-13)

- Adds compatibility with Swift Performance Pro
- Preload instantpage.min.js as a Module and not as Script
- Fix is_404 incorrect call
- Bypass caching on password-protected pages
