package com.example.creativecritic;

import com.example.creativecritic.webservices.GetReviewsRequest;
import com.example.creativecritic.webservices.IResultListener;
import com.example.creativecritic.webservices.MakeReviewRequest;
import com.example.creativecritic.webservices.Request;
import com.example.creativecritic.webservices.Webservices;

public class CreateCriticWebservices extends Webservices {
	private static CreateCriticWebservices instance;
	private CreateCriticWebservices(){
		
	}
	public static CreateCriticWebservices getInstance(){
		if(instance==null){
			instance = new CreateCriticWebservices();
		}
		return instance;
	}
	public void requestUserFromDevice(IResultListener resultListener){
		
	}
public Request requestUserFromEmail(IResultListener resultListener){
		return super.request(new UserLoginRequest(resultListener));
	}
	public Request requestSubordinates(IResultListener resultListener, int category_id){
		return super.request(new SubordinatesRequest(resultListener, category_id));
	}
	public Request makeReview(IResultListener resultListener, String review_text, int score, int user_id, int category_id){
		return super.request(new MakeReviewRequest(resultListener, review_text, score, user_id, category_id));
	}
	public Request getReviews(IResultListener resultListener, int category_id){
		return super.request(new GetReviewsRequest(resultListener, category_id));
	}
}
