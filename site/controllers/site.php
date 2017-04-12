<?php

return function($site, $pages, $page) {
  return array(
    'projectsPage' => $site->projectpage()->toPage(),
    'projects' => $site->projectpage()->toPage()->children()->visible()
  );
};