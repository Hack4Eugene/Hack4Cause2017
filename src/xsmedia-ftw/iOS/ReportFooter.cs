using System;
using UIKit;
using CoreGraphics;

namespace Trafficing.iOS
{
	public class ReportFooter : UIView
	{
		public ReportFooter()
		{
			BackgroundColor = UIColor.Clear;
		}

		public override void Draw(CGRect rect)
		{
			base.Draw(rect);

			using (CGContext g = UIGraphics.GetCurrentContext())
			{
				UIColor.Gray.SetStroke();
				UIColor.Black.SetFill();

				g.SetLineWidth(6);

				//footer box
				var path2 = new CGPath();
				path2.AddLines(new CGPoint[]{
					new CGPoint(3,870),
					new CGPoint(372,870),
					new CGPoint(372,965),
					new CGPoint(3,965)});

				path2.CloseSubpath();

				g.AddPath(path2);
				g.DrawPath(CGPathDrawingMode.FillStroke);

				//subheader line
				g.SetLineWidth(2);
				var path4 = new CGPath();
				path4.AddLines(new CGPoint[]{
					new CGPoint(10,70),
					new CGPoint(365,70)});

				path4.CloseSubpath();

				g.AddPath(path4);
				g.DrawPath(CGPathDrawingMode.Stroke);

				//subheader line2
				var path5 = new CGPath();
				path5.AddLines(new CGPoint[]{
					new CGPoint(65,240),
					new CGPoint(305,240)});

				path5.CloseSubpath();

				g.AddPath(path5);
				g.DrawPath(CGPathDrawingMode.Stroke);

				//subheader line3
				var path = new CGPath();
				path.AddLines(new CGPoint[]{
					new CGPoint(65,510),
					new CGPoint(305,510)});

				path.CloseSubpath();

				g.AddPath(path);
				g.DrawPath(CGPathDrawingMode.Stroke);

				//text
				UIColor.Black.SetFill();
				g.ScaleCTM(1f, -1f);
				g.SelectFont("Arial", 30f, CGTextEncoding.MacRoman);
				g.SetTextDrawingMode(CGTextDrawingMode.Fill);
				g.ShowTextAtPoint(90, -50, "Incident Report");
				g.SelectFont("Arial", 24f, CGTextEncoding.MacRoman);
				g.ShowTextAtPoint(30, -110, "Date of Incident:");
				g.ShowTextAtPoint(30, -150, "Time of Incident:");
				g.SelectFont("Arial", 28f, CGTextEncoding.MacRoman);
				g.ShowTextAtPoint(80, -220, "Vehicle Involved");
				g.SelectFont("Arial", 24f, CGTextEncoding.MacRoman);
				g.ShowTextAtPoint(30, -280, "Make:");
				g.ShowTextAtPoint(30, -320, "Model:");
				g.ShowTextAtPoint(30, -360, "License Plate:");
				g.ShowTextAtPoint(30, -400, "Driver:");
				g.SelectFont("Arial", 28f, CGTextEncoding.MacRoman);
				g.ShowTextAtPoint(70, -470, "Suspicious Person");
				g.SelectFont("Arial", 18f, CGTextEncoding.MacRoman);
				g.ShowTextAtPoint(90, -490, "(This is a possible Pimp)");
				g.SelectFont("Arial", 24f, CGTextEncoding.MacRoman);
				g.ShowTextAtPoint(30, -550, "Gender:");
				g.ShowTextAtPoint(30, -590, "Race:");
				g.ShowTextAtPoint(30, -630, "Height:");
				g.ShowTextAtPoint(30, -670, "Age:");
				g.ShowTextAtPoint(30, -710, "Hair Color:");
				g.ShowTextAtPoint(30, -750, "Hair Length:");
				g.ShowTextAtPoint(30, -790, "Eye Color:");
			}
		}
	}
}
