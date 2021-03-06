package com.example.creativecritic;

import java.util.List;

public class Category {
	private String name;
	private int id;
	private float score;
	private int rgt;
	private int lft;
	private List<String> google_images;
	public Category(String name, float score, int id, int rgt, int lft, List<String> google_images) {
		// TODO Auto-generated constructor stub
		this.name=name;
		this.id=id;
		this.lft=lft;
		this.rgt=rgt;
		this.score=score;
		this.google_images=google_images;
	}
	public float getScore(){
		return score;
	}
	public String getName(){
	return name;
	}
	public int getId(){
		return id;
	}
	public boolean hasChildren(){
		return rgt-lft>1;
	}
	public int getRgt(){
		return rgt;
	}
	public int getLft(){
		return lft;
	}
	public List<String> getGoogleImages(){
		return google_images;
	}
}
