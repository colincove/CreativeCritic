package com.example.creativecritic;

import com.nostra13.universalimageloader.core.DisplayImageOptions;
import com.nostra13.universalimageloader.core.ImageLoader;
import com.nostra13.universalimageloader.core.ImageLoaderConfiguration;
import com.nostra13.universalimageloader.core.assist.ImageScaleType;

import android.app.Application;
import android.os.Bundle;

public class CreativeCriticApplication extends Application {

	public CreativeCriticApplication() {
		// TODO Auto-generated constructor stub
	}
	
	public void onCreate(){
		super.onCreate();
		// Create global configuration and initialize ImageLoader with this configuration
		DisplayImageOptions defaultOptions = new DisplayImageOptions.Builder()
        .cacheInMemory(false)
        .cacheOnDisc(true)
        .imageScaleType(ImageScaleType.EXACTLY)
        .build();
        ImageLoaderConfiguration config = new ImageLoaderConfiguration.Builder(getApplicationContext())
        .defaultDisplayImageOptions(defaultOptions)
        .build();
        ImageLoader.getInstance().init(config);
	}

}
