<?php

declare(strict_types=1);

namespace Yard\Database\Traits;

use Illuminate\Support\Collection;
use WP_Query;

trait Related
{
	public function posts(string $postType, int $perPage = 3, string $orderBy = 'DESC'): Collection
	{
		$query = new WP_Query([
			'post_type' => $postType,
			'post_status' => 'publish',
			'posts_per_page' => $perPage,
			'orderby' => $orderBy,
			'post__not_in' => [$this->id],
		]);

		return new Collection($query->posts);
	}

	public function randomPosts(string $postType, int $perPage = 3): Collection
	{
		return $this->posts($postType, $perPage, 'rand');
	}

	public function nextPosts(string $postType, int $perPage = 3): Collection
	{
		return $this->posts($postType, $perPage);
	}

	public function relatedPostsByTaxonomy(string $postType, string $taxonomyKey, Collection $taxonomyTerms, int $perPage = 3, string $orderBy = 'rand'): Collection
	{
		if ($taxonomyTerms->isEmpty() || strlen($taxonomyKey) === 0) {
			return collect();
		}

		$query = new WP_Query([
			'post_type' => $postType,
			'post_status' => 'publish',
			'posts_per_page' => $perPage,
			'orderby' => $orderBy,
			'post__not_in' => [$this->id],
			'tax_query' => [
				[
					'taxonomy' => $taxonomyKey,
					'field' => 'slug',
					'terms' => $taxonomyTerms->pluck('slug')->toArray(),
				],
			],
		]);

		return new Collection($query->posts);
	}

	public function relatedPostsBySearchPhrase(string $searchPhrase): Collection
	{
		$query = new WP_Query([
			'post_type' => $this->postType,
			'post_status' => 'publish',
			'orderby' => 'title',
			'order' => 'ASC',
			'post__not_in' => [$this->id],
			's' => $searchPhrase,
			'posts_per_page' => 7,
		]);

		return new Collection($query->posts);
	}
}
