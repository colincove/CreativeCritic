package com.example.creativecritic;

import com.example.creativecritic.webservices.IResultListener;
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
public void requestUserFromEmail(IResultListener resultListener){
		super.request(new UserLoginRequest(resultListener));
	}
}
