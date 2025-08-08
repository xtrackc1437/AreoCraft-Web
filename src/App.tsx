import Navbar from './components/Navbar';
import Hero from './components/Hero';
import Gallery from './components/Gallery';
import Features from './components/Features';
import FAQ from './components/FAQ';
import JoinSection from './components/JoinSection';
import Footer from './components/Footer';
import './App.css';

function App() {
  return (
    <div className="App">
      <Navbar />
      <Hero />
      <Gallery />
      <Features />
      <FAQ />
      <JoinSection />
      <Footer />
    </div>
  );
}

export default App
