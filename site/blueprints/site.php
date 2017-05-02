<?php if(!defined('KIRBY')) exit ?>

title: Site
fields:
  generalSettings:
    label: Site Settings
    type: tabs
  title:
    label: Title
    type:  text
    width: 1/2
  projectpage:
    label: Main project page
    type: select
    width: 1/2
    options: query
    required: true
    query:
      fetch: pages
      template: projects
  description:
    label: Description
    type:  textarea
    width: 1/2
  seo:
    label: Special SEO Description
    type: textarea
    width: 1/2
    help: Will be displayed on search engines only (optional)
  tagline:
    label: Tagline
    type: textarea
  keywords:
    label: Keywords
    type:  tags
  customcss:
    label: Custom CSS
    type: textarea
    buttons: false
  googleAnalytics:
    label: Google Analytics ID
    type: text
    icon: code
    help: Tracking ID in the form UA-XXXXXXXX-X. Keep this field empty if you are not using it.
    width: 1/2
  ogimage:
    label: Facebook OpenGraph image
    type: image
    help: 1200x630px minimum
    width: 1/2
  footerSettings:
    label: Footer Settings
    type: tabs
  footertitle:
    label: Footer Title
    type: text
  footertext1:
    label: Text
    type: textarea
  footeraddress:
    label: Address
    type: textarea
  footercontact:
    label: Contact
    type: textarea
  insta:
    label: Instagram
    type: url
  linkedin:
    label: Linkedin
    type: url