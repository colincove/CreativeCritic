package com.example.creativecritic;

import org.apache.http.HttpResponse;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

import com.example.creativecritic.webservices.IResultListener;
import com.example.creativecritic.webservices.Request;
import com.example.creativecritic.webservices.Result;

public class UserLoginRequest extends Request {
	public UserLoginRequest(IResultListener resultListener){
		super(resultListener);
		nameValuePairs.add(new BasicNameValuePair("email", "stinky@stink.com"));
		nameValuePairs.add(new BasicNameValuePair("action", "get_user_by_email"));
		this.url="http://www.covertstudios.ca/IAT381/mobile_services.php";
	}
	@Override
	public Result createResult(JSONObject jObj){
		//response.
		User user = new User(4, "3434342");
		return new UserLoginResult(true, this, user);
	}
}
