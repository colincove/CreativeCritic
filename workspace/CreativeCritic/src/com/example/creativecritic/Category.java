package com.example.creativecritic;

public class Category {
	private String name;
	private int id;
	private float score;
	private int rgt;
	private int lft;
	public Category(String name, float score, int id, int rgt, int lft) {
		// TODO Auto-generated constructor stub
		this.name=name;
		this.id=id;
		this.lft=lft;
		this.rgt=rgt;
		this.score=score;
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
}
