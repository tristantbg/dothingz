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
    label: Featured Images
    type: tabs
  featuredImages:
    label: Featured Images
    type: gallery
  globalSettings:
    label: Global order
    type: tabs
  globalorder:
    label: Global order
    type: structure
    style: table
    fields:
      project:
        label: Project
        type: quickselect
        options: children
        placeholder: Choose a project...
        required: true
      featuredimage:
        label: Custom Featured image
        type: quickselect
        options: images
        help: Optional
      highlight:
        label: Highlighted project
        type: toggle
        options: yes/no
        default: no