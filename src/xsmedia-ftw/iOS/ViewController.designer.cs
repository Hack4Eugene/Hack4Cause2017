// WARNING
//
// This file has been generated automatically by Xamarin Studio from the outlets and
// actions declared in your storyboard file.
// Manual changes to this file will not be maintained.
//
using Foundation;
using System;
using System.CodeDom.Compiler;

namespace Trafficing.iOS
{
    [Register ("ViewController")]
    partial class ViewController
    {
        [Outlet]
        UIKit.UIButton Button { get; set; }

        [Outlet]
        [GeneratedCode ("iOS Designer", "1.0")]
        UIKit.UILabel AppName { get; set; }

        [Outlet]
        [GeneratedCode ("iOS Designer", "1.0")]
        UIKit.UIView Main_Splash { get; set; }

        void ReleaseDesignerOutlets ()
        {
            if (AppName != null) {
                AppName.Dispose ();
                AppName = null;
            }

            if (Main_Splash != null) {
                Main_Splash.Dispose ();
                Main_Splash = null;
            }
        }
    }
}