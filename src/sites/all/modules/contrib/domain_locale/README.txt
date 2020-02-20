Requirements:
- set language negotiation to "Path prefix only". We are overriding $language in
  bootstrap hence overwriting any changes that might of been user's preferred
  language specific. Also user's preferred language might not exist all domains.
  You can leave the setting to "Path prefix with language fallback" but the
  language fallback will be overwritten.

Optional:
- make sure all languages have a prefix (by default English does not). This
  gives unique URLS for all languages.

Configuration:
- ALWAYS edit the available languages for a domain at:
  /admin/structure/domain/view/[domain_id]/language
- NEVER disable languages at:
  /admin/config/regional/language
- You can get more information about it at https://drupal.org/node/2011804

This module provides drush integration.
Syntax:
domain-locale-setdomain_machine_name 'list of language codes' --defalt=language code
Eg.: domain-locale-set usa.example.com 'en es' --default=en
