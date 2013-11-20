package com.example.creativecritic.webservices;

public class CategoryReview {
	private int review_id;
	private String review_text;
	private String modified;
	private int score;
	private int user_id;
	private int category_id;
	public CategoryReview(int review_id, String review_text, String modified, int score, int user_id, int category_id) {
		this.review_id = review_id;
		this.review_text = review_text;
		this.modified = modified;
		this.score = score;
		this.user_id = user_id;
		this.category_id = category_id;
	}
	public int getReviewId(){
		return review_id;
	}
	public String getReviewText(){
		return review_text;
		
	}
	public int getScore(){
		return score;
	}
	public int getUserId(){
		return user_id;
	}
	public int getCategoryId(){
		return category_id;
	}
	@ Override
	public String toString(){
		return "Score: "+score+" : "+review_text;
	}
}
/*
 * 
 * {"status":1,"data":[{"review_id":"2","review_text":"","modified":"0000-00-00 00:00:00","score":"20","user_id":"2","category_id":"10"},{"review_id":"3","review_text":"I loved it. It was cool. ","modified":"0000-00-00 00:00:00","score":"80","user_id":"2","category_id":"10"}]}
 */
