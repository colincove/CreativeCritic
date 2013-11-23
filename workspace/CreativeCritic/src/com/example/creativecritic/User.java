package com.example.creativecritic;

public class User {
	private String email;
	private String device;
	private String name;
	private int id;
	public static User currentUser;
	public User(int id, String email, String name) {
		// TODO Auto-generated constructor stub
		this.id=id;
		this.email=email;
		this.name=name;
		currentUser=this;
	}
	public User(int id, String device) {
		// TODO Auto-generated constructor stub
		this.id=id;
		this.device=device;
	}
	public String getEmail(){
		return email;
	}
	public String getName(){
		return name;
	}
	public String getDevice(){
		return device;
	}
	public int getId(){
		return id;
	}
}
