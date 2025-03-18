import AOS from 'aos';
import 'aos/dist/aos.css';

export default function (app) {
    app.AOS = AOS;
    app.use(AOS.init(
        {
            duration: 800,
            easing: 'ease-out-back',
            offset: 50
          }
    ));
}