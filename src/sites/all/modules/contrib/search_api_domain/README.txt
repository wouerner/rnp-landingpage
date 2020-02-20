Description:
============

This module adds an extra field "Domain Access Information" to the Search API index "Fields" tab.
When checked, the returned search results will be filtered based on the Domain Access settings.
I.e. a node that is published to a certain domain, will not show up in the search results of other domains.

Installation:
=============
- Go to admin/config/search/search_api/index/[SEARCH_INDEX_NAME]/fields
- Check the box for "Domain Access Information"
- Re-index your search index

Credits:
========
Code based on the following issue: https://drupal.org/node/1336180
Thanks to ximo, leewillis77 & mikeskull for their code.
