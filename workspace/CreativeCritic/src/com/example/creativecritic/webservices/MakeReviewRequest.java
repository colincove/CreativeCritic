package com.example.creativecritic.webservices;

import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

import com.example.creativecritic.User;
import com.example.creativecritic.UserLoginResult;

public class MakeReviewRequest extends Request {

	public MakeReviewRequest(IResultListener resultListener, String review_text, int score, int user_id, int category_id) {
		super(resultListener);
		nameValuePairs.add(new BasicNameValuePair("review_text", review_text));
		nameValuePairs.add(new BasicNameValuePair("score", Integer.toString(score)));
		nameValuePairs.add(new BasicNameValuePair("user_id", Integer.toString(user_id)));
		nameValuePairs.add(new BasicNameValuePair("category_id", Integer.toString(category_id)));
		nameValuePairs.add(new BasicNameValuePair("action", "make_review"));
		this.url="http://www.covertstudios.ca/IAT381/mobile_services.php";
	}
	@Override
	public Result createResult(JSONObject jObj){
		//response.
		return new Result(true, this);
	}

}
