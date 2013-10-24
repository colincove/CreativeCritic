package com.example.creativecritic.webservices;

import java.util.UUID;

public class Result {
	private boolean status;
	private Request request;
	public Result(boolean status, Request requestId){
		this.status = status;
		this.request=requestId;
	}
	public boolean getStatus(){
		return status;
	}
	public Request getRequest(){
		return request;
	}
}
