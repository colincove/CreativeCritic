package com.example.creativecritic;

import com.example.creativecritic.webservices.Request;
import com.example.creativecritic.webservices.Result;

public class UserLoginResult extends Result {
	private User user;
	public UserLoginResult(boolean status, Request requestId, User user) {
		super(status, requestId);
		this.user=user;
	}
	public User getUser(){
		return user;
	}

}
