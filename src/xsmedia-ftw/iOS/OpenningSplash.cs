using UIKit;
using CoreGraphics;

namespace Trafficing.iOS
{
	public class OpenningSplash : UIView
	{
		public OpenningSplash()
		{
			BackgroundColor = UIColor.Black;
		}

		public override void Draw(CGRect rect)
		{
			base.Draw(rect);

			using (CGContext g = UIGraphics.GetCurrentContext())
			{
				//header box
				g.SetLineWidth(6);
				UIColor.Gray.SetStroke();
				UIColor.Black.SetFill();

				var path = new CGPath();
				path.AddLines(new CGPoint[]{
					new CGPoint (3,25),
					new CGPoint (372,25),
					new CGPoint (372,100),
					new CGPoint (3,100)});

				path.CloseSubpath();

				g.AddPath(path);
				g.DrawPath(CGPathDrawingMode.FillStroke);

				//footer box
				var path2 = new CGPath();
				path2.AddLines(new CGPoint[]{
					new CGPoint(3,570),
					new CGPoint(372,570),
					new CGPoint(372,665),
					new CGPoint(3,665)});

				path2.CloseSubpath();

				g.AddPath(path2);
				g.DrawPath(CGPathDrawingMode.FillStroke);

				//center line
				g.SetLineWidth(2);
				var path3 = new CGPath();
				path3.AddLines(new CGPoint[]{
					new CGPoint(10,355),
					new CGPoint(365,355)});

				path3.CloseSubpath();

				g.AddPath(path3);
				g.DrawPath(CGPathDrawingMode.FillStroke);

				//text
				UIColor.White.SetFill();
				g.ScaleCTM(1f, -1f);
				g.SelectFont("Arial", 20f, CGTextEncoding.MacRoman);
				g.SetTextDrawingMode(CGTextDrawingMode.Fill);
				g.ShowTextAtPoint(50, -150, "Help free sex trafficking victims");
				g.SelectFont("Arial", 18f, CGTextEncoding.MacRoman);
				g.ShowTextAtPoint(70, -290, "Your report will be sent to the");
				g.ShowTextAtPoint(60, -310, "Lane County Human Trafficking");
				g.ShowTextAtPoint(75, -330, "Task Force for investigation");
				g.ShowTextAtPoint(60, -390, "Not sure you're witnessing a sex");
				g.ShowTextAtPoint(75, -410, "trafficking scenario? Use our");
				g.ShowTextAtPoint(45, -430, "quick guide to help identify the signs");
			}
		}
	}
}
