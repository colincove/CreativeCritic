package com.example.creativecritic;

public class CategoryPathNode {
	private int category_id;
	private String name;
	public CategoryPathNode(String name, int category_id) {
		this.name=name;
		this.category_id=category_id;
	}
	public String getName(){
		return name;
	}
	public int getCategoryId(){
		return category_id;
	}
	public String toString(){
		return name;
	}
}
