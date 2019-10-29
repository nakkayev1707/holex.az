### CHANGE LOG:

**v6.2.2**

- [2017-05-26] - MOD - Password generator for CMS users improved (added "I have copied this password in a safe place." checkbox and "Generate again" button)
- [2017-05-18] - MOD - The landing page is now not hardcoded, it is stored in database and can be defined for each role individually
- [2017-05-14] - MOD - Dependency `CKeditor-4.6.2` update
- [2017-05-08] - NEW - `Utils` helper functions `utils::validateDatetime($date[, $format])`, `utils::file2base64($fname)`, `utils::mime2ext($mime)`, `utils::base64_to_file($str, $dir)`, `utils::getAge($birth_date[, $stringify=true])` added
- [2017-05-07] - MOD - Navigation page restored

**v6.2.1**

- [2017-04-16] - NEW - Saving and restoring menu sidebar status is implemented
- [2017-04-15] - FIX - Fixed "undefined" message when logging in via social buttons and such user is not found in database
- [2017-04-11] - FIX - Generate menu regarding to user privilegies
- [2017-04-11] - FIX - Custom avatar output fixed in user dropdown at header
- [2017-04-09] - FIX - At articles editing page jQuery autocomplete for gallery picking replaced with Select2
- [2017-04-06] - NEW - `Utils` helper function `Utils::isAjax()` & `Utils::getOnlyWords()` added
- [2017-04-06] - NEW - `View` helper function `view::create_url()` added
- [2017-04-06] - MOD - `View` helper function `view::menu()` improved to allow block items with url and no sub-items

**v6.2.0**

- [2017-04-05] - BRANCH - Branch https://bitbucket.org/profitaz/undp-panama-country-fiche created
- [2017-04-05] - BRANCH - Branch https://bitbucket.org/profitaz/hindustani-children-autism-diagnostic created

**v6.1.1**

- [2017-04-03] - MOD - DB adapter's `CMS::$db->mod()` function changed - fourth parameter accepts params now

**v6.1.0**

- [2017-03-31] - BRANCH - Branch https://bitbucket.org/profitaz/tn-muassiselerin-qaydalari created

**v6.0.10**

- [2017-02-01] - MOD - Gallery photos adding and editing page restored
- [2017-01-30] - MOD - Gallery photos listing page restored
- [2017-01-28] - FIX - Fixed change of CMS language if saving another's user settings
- [2017-01-28] - MOD - Changing CMS user's avatar implemented
- [2017-01-28] - MOD - `Utils` helper function `Utils::upload()` improved - if directory is not exists, create it

**v6.0.9**

- [2017-01-21] - NEW - `Utils` helper function `Utils::translit_kb_ru2az()` fixed and `Utils::az_upper()` added
- [2017-01-21] - MOD - Gallery editing page restored

**v6.0.8**

- [2017-01-21] - NEW - Widgets support added. Sample "breadcrumbs" widget implemented. Task #15 closed.
- [2017-01-20] - MOD - Gallery adding page restored
- [2017-01-19] - MOD - Galleries listing page restored
- [2017-01-15] - NEW - `BootBox 4.4.0` modal dialogs support added
- [2017-01-15] - FIX - Gallery linking error fixed
- [2017-01-04] - FIX - Dependency `jquery-ui-1.12.1` update (in order to fix tooltip conflict with bootstrap)
- [2017-01-04] - FIX - Security: 1 XSS and some Application errors fixed
- [2017-01-04] - NEW - Dashboard: articles and CMS users counters added
- [2017-01-04] - MOD - Articles editing page restored

**v6.0.7**

- [2017-01-03] - NEW - `Utils` helper function `utils::safeCleanMarkupEcho($str, $return=false, $limit=1000)` added
- [2017-01-02] - NEW - English language translations added

**v6.0.6**

- [2016-12-21] - FIX - `Utils` helper functions `Utils::safeEcho()` and `Utils::safeJsEcho()` fixed
- [2016-12-17] - MOD - Dependencies updated (admin-lte-2.3.7, bootstrap-3.3.7, CKeditor-4.6.1)
- [2016-12-17] - MOD - Articles adding page restored
- [2016-12-05] - MOD - Articles listing page restored
- [2016-11-24] - MOD - Dashboard 2 miniblocks added: users and comments count

**v6.0.5**

- [2016-11-24] - FIX - `Utils` helper functions `utils::trueLink($allowed_keys)` bugs fixed
- [2016-11-24] - MOD - Comments moderation restored
- [2016-11-24] - MOD - Comments listing page restored

**v6.0.4**

- [2016-11-17] - MOD - Site users view info page restored
- [2016-11-17] - MOD - Site users listing restored
- [2016-11-16] - MOD - CMS users editing restored, bugs fixed

**v6.0.3**

- [2016-11-04] - NEW - `Utils` helper functions added and bugs fixed `utils::makeSEF()`, `Utils::getYearsOld($birth_date)`, `utils::strCollapseSpaces($str)`
- [2016-10-18] - MOD - CMS users deletion restored

**v6.0.2**

- [2016-09-23] - MOD - Database `utf8mb4` encoding support started
- [2016-09-14] - MOD - CMS users adding restored
- [2016-09-12] - NEW - `Utils` helper function `Utils::copyFile()` implemented
- [2016-09-12] - MOD - CMS users listing page restored

**v6.0.1**

- [2016-09-05] - MOD - CMS users privilegies checking reworked
- [2016-08-23] - FIX - CMS Controller/Model conflict resolved
- [2016-08-21] - NEW - Dashboard page implemented
- [2016-08-20] - MOD - Authorization via social networks implemented
- [2016-08-14] - NEW - 404 page implemented
- [2016-08-14] - NEW - Password recovery page implemented

**v6.0.0**

- [2016-07-20] - MOD - Full MVC architecture support started
- [2016-07-20] - NEW - [Namespaces](http://www.php.net/namespace) implemented
- [2016-07-12] - MOD - "Sign in" page redesigned according to [AdminLTE skin](https://almsaeedstudio.com/themes/AdminLTE/pages/examples/login.html)
- [2016-07-11] - MOD - [PSR-4 standard](http://www.php-fig.org/psr/psr-4/) compliant directories structure support started