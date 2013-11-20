package com.example.creativecritic.webservices;

import java.util.List;

public class GetReviewsResult extends Result {
	private List<CategoryReview> reviews;
	public GetReviewsResult(boolean status, Request requestId, List<CategoryReview> reviews) {
		super(status, requestId);
		this.reviews = reviews;
	}
	public List<CategoryReview> getReviews(){
		return reviews;
	}
}
