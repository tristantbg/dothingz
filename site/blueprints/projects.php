<?php if(!defined('KIRBY')) exit ?>

title: Projects
pages:
  template: project
files:
  fields:
    focus:
      label: Focus Crop
      type: focus
fields:
  title:
    label: Title
    type:  text
  featuredSettings:
    label: Featured Projects
    type: tabs
  featuredProjects:
    label: Featured Projects
    type: structure
    style: table
    fields:
      fp:
        label: Project
        type: quickselect
        options: visibleChildren
        required: true
        width: 1/2
      fpimage:
        label: Custom Image
        type: image
        help: Optional
        width: 1/2
      fptext:
        label: Custom Text
        type: text
        help: Optional
        width: 1/2
      fpcolor:
        label: Text color
        type: radio
        columns: 1
        width: 1/2
        options:
          black: Black
          white: White
  recentSettings:
    label: Recent Project
    type: tabs
  recenttoggle:
    label: Recent project ?
    type: fieldtoggle
    width: 1/2
    options:
      yes: "Yes"
      no: "No"
    show:
      yes: recentproject recentimage recentcolor
    hide:
      no: recentproject recentimage recentcolor
  recentproject:
    label: Recent project
    type: quickselect
    options: visibleChildren
    value: '{{uri}}'
    width: 1/2
  recentimage:
    label: Custom Image
    type: image
    help: Leave empty to keep original featured image
    width: 1/2
  recentcolor:
    label: Text color
    type: radio
    width: 1/2
    options:
      black: Black
      white: White