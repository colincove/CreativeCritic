package com.example.creativecritic;

public class Category {
	private String name;
	private int id;
	private int score;
	public Category(String name, int id) {
		// TODO Auto-generated constructor stub
		this.name=name;
		this.id=id;
	}
	public String getName(){
	return name;
	}
	public int getId(){
		return id;
	}
}
