<?php

declare(strict_types=1);

namespace Yard\Database\Model;

use Corcel\Model\Post as CorcelPost;
use Exception;
use Spatie\LaravelData\WithData;
use Yard\Data\PostData;


class Post extends CorcelPost
{
	use WithData;

	protected string $dataClass = PostData::class;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'post_content',
		'post_title',
		'post_excerpt',
		'post_type',
		'post_name',
		'post_status',
		'post_date',
		'post_modified',
	];

	/**
	 * The model's default values for attributes.
	 *
	 * @var array
	 */
	protected $attributes = [
		'to_ping' => '',
		'pinged' => '',
		'post_content_filtered' => '',
		'comment_status' => 'closed',
		'ping_status' => 'closed',
	];

	/**
	 * @param string $taxonomy
	 * @param int|string|array<string>|array<int> $terms
	 *
	 * @return array<string, array<int>>
	 *
	 * @throws Exception
	 */
	public function setTerms(string $taxonomy, int|string|array $terms): array
	{
		$tti = wp_set_object_terms($this->ID, $terms, $taxonomy);

		if (is_wp_error($tti)) {
			throw new Exception($tti->get_error_message());
		}

		return $tti;
	}
}
