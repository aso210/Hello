# android  jni编程 #
## 介绍 ##
近期工作中需要实现apk增量更新功能，研究了github上的[SmartAppUpdates](https://github.com/cundong/SmartAppUpdates "SmartAppUpdates")后发现实现增量更新主要使用到了开源的C库  
在android调用C需要使用到jni技术，下面记录一下如何通过ndk生成so文件。

## 步骤 ##
1. 安装NDK  
注意安装路径不能包含空格，否则执行命令时将会报错  
安装完成后将NDK路径配置到Path环境变量中

2. docs窗口定位到android工程目录src下，输入:  
 `javac com\cundong\utils\PatchUtils.java`  
若出现中文导致编译错误：  
![](http://i.imgur.com/Kn1Ug4H.png)  
可使用：  
`javac -encoding utf-8 com\cundong\utils\PatchUtils.java`  

3. javac编译成功之后，输入:  
`javah com.cundong.utils.PatchUtils`  
注意：包名用'.'号间隔，且当前路径必须在src目录下  
执行成后会在src同级目录下生成 com_cundong_utils_PatchUtils.h 头文件   

4. 将生成的头文件剪切到android工程根目录jni文件夹下，编写 com_cundong_utils_PatchUtils.c 实现头文件中声明的方法

5. 编写Application.mk和Android.mk  

6. docs定位到jni目录中，执行 ndk-build.cmd,若执行正确则将在libs目录下的相应目录生成so文件：armeabi，armeabi-v7a等


# 开启JNI中log: 
在Java环境下使用JNI时可以方便的使用printf函数打印信息，在Eclipse控制台Console视图可以方便的观察到，可在Android环境下使用JNI的话，printf函数就无效了，LogCat视图和Console视图里看不到任何输出.但在android编程java代码中，我们使用Log.v等一些将日志输出到logcat，在LogCat视图中可以看到日志输出信息。
android NDK完全支持JNI本地方法调试。它提供4个android_log_XXX函数供我们使用。

设置输出log信息的步骤:
1. 在Android.mk中添加如下内容：  
`LOCAL_LDLIBS:=-L$(SYSROOT)/usr/lib -llog`  
2. 在.c或.cpp文件中引用log头文件  
 `#include <android/log.h>`  
 `#define TAG "myDemo-jni" // 这个是自定义的LOG的标识`
`#define LOGD(...) __android_log_print(ANDROID_LOG_DEBUG,TAG ,__VA_ARGS__) // 定义LOGD类型`
`#define LOGI(...) __android_log_print(ANDROID_LOG_INFO,TAG ,__VA_ARGS__) // 定义LOGI类型`
`#define LOGW(...) __android_log_print(ANDROID_LOG_WARN,TAG ,__VA_ARGS__) // 定义LOGW类型`
`#define LOGE(...) __android_log_print(ANDROID_LOG_ERROR,TAG ,__VA_ARGS__) // 定义LOGE类型`
`#define LOGF(...) __android_log_print(ANDROID_LOG_FATAL,TAG ,__VA_ARGS__) // 定义LOGF类型`
3. 使用LOGD等进行log打印输出