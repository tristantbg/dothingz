<?php if(!defined('KIRBY')) exit ?>

title: Project
pages: false
files:
  fields:
    focus:
      label: Focus Crop
      type: focus
fields:
  tab1:
    label: General
    type:  tabs
  prevnext: prevnext
  title:
    label: Title
    type:  text
    width: 1/2
  featured:
    label: Featured image
    type: image
    width: 1/2
  categories:
    label: Categories
    type: tags
  text:
    label: Text
    type:  textarea
    width: 1/2
  readmore:
    label: Read more text
    type: textarea
    help: Leave empty if no need
    width: 1/2
  tab2:
    label: Content
    type:  tabs
  builder:
    label: Sections
    type: builder
    fieldsets:
      imagesection:
        label: Image
        entry: >
          <img src="{{_thumb}}" />
        fields:
          picture:
            label: Image
            type: image
      twoimagessection:
        label: Two Images
        entry: >
          <img src="{{_thumb}}" width="49%" />
          <img src="{{_thumb2}}" width="49%" />
        fields:
          picture:
            label: Image 1
            type: image
            width: 1/2
          picture2:
            label: Image 2
            type: image
            width: 1/2
          cropratio:
            label: Crop Ratio
            type: radio
            options:
              original: No Crop
              1_1: 1/1
              2_3: 2/3
              5_7: 5/7
      slidersection:
        label: Slider
        entry: >
          <img src="{{_thumb}}" />
          <p>Start new slider : {{new}}</p>
        fields:
          picture:
            label: Slider Image
            type: image
            width: 1/2
          new:
            label: Start new slider
            type: toggle
            options: yes/no
            default: no
            help: Necessary when 2 sliders follow each other
            width: 1/2
      videosection:
        label: Video
        entry: >
          <p>Video ID : {{videourl}}</p>
          <p>Video File : {{videofile}}</p>
        fields:
          videourl:
            label: Video ID
            type: text
            icon: code
            help: Youtube or Vimeo
          videofile:
            label: Video file
            type: quickselect
            options: videos