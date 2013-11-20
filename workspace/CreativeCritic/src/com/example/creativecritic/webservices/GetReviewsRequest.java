package com.example.creativecritic.webservices;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class GetReviewsRequest extends Request {

	public GetReviewsRequest(IResultListener resultListener,int category_id) {
		super(resultListener);
		nameValuePairs.add(new BasicNameValuePair("catagory_id", Integer.toString(category_id)));
		nameValuePairs.add(new BasicNameValuePair("action", "get_catagory_reviews"));
		this.url="http://www.covertstudios.ca/IAT381/mobile_services.php";
	}
	@Override
	public Result createResult(JSONObject jObj){
		//int review_id, String review_text, String modified, int score, int user_id, int category_id
		try {
			JSONArray data   = jObj.getJSONArray("data");
			List<CategoryReview> reviews = new ArrayList<CategoryReview>();
			for(int i=0;i<data.length();i++){
				reviews.add(new CategoryReview(
						data.getJSONObject(i).getInt("review_id"), 
						data.getJSONObject(i).getString("review_text"), 
						data.getJSONObject(i).getString("modified"), 
						data.getJSONObject(i).getInt("score"), 
						data.getJSONObject(i).getInt("user_id"),
						data.getJSONObject(i).getInt("category_id")
						));
			}
			return new GetReviewsResult(true, this, reviews);
		} catch (JSONException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		return new Result(false, this);
	}

}
