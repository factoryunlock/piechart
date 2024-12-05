import React from 'react';
import { createRoot } from 'react-dom/client';
import { StrictMode } from 'react';
import { PieChart, tokenData } from './components/TokenDistribution';
import './index.css';

declare global {
  interface Window {
    initTokenChart: (elementId: string) => void;
  }
}

const initTokenChart = (elementId: string) => {
  const container = document.getElementById(elementId);
  if (!container) return;
  
  createRoot(container).render(
    <StrictMode>
      <div className="bg-gray-950 p-8 rounded-lg">
        <PieChart data={tokenData} />
      </div>
    </StrictMode>
  );
}

window.initTokenChart = initTokenChart;

export { initTokenChart };