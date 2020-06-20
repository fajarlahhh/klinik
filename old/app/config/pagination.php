<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['query_string_segment'] = 'start';

$config['full_tag_open'] = "<ul class='pagination pagination-sm no-margin pull-right'>";
$config['full_tag_close'] ="</ul>";

$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';

$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';

$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';

$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";

$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';

$config['per_page'] = 10;
$config["page_query_string"] = TRUE;
$config["use_page_numbers"] = false;
$config["query_string_segment"] = 'pg';